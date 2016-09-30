<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class Skype extends Controller
{
    //
    /**
     * Connects you to the specified Skype account
     *
     * $skypeUsername -> your skype username
     * $skypePassword -> your skype password
     * $cacheDir -> folder to use for the cache
     */
    public function __construct($skypeUsername, $skypePassword, $cacheDir = "skypephp_cache") {
        $this->username = $skypeUsername;
        $this->password = $skypePassword;
        $this->cacheDir = $cacheDir;
        $this->lastPoll = time();

        if (file_exists("$cacheDir/")) {
            if (file_exists("$cacheDir/$skypeUsername")) {
                $tokens = explode("|", file_get_contents("$cacheDir/$skypeUsername"));
                if (count($tokens) != 3 || count($tokens) == 3 && time() >= $tokens[2]) {
                    unlink("$cacheDir/$skypeUsername");
                    unset($tokens);
                }
            }
        } else {
            mkdir($cacheDir);
            if (!file_exists("$cacheDir/")) exit(trigger_error("Skype : Unable to create the cache directoy.", E_USER_WARNING));
        }

        if (!isset($tokens)) {
            $authentification = $this->web("https://login.skype.com/login?client_id=578134&redirect_uri=https%3A%2F%2Fweb.skype.com", "GET", null, true);


            $tokens = Array(
                "username" => $skypeUsername,
                "password" => $skypePassword,
                "pie" => $this->extractToken($authentification, "pie"),
                "etm" => $this->extractToken($authentification, "etm"),
                "js_time" => $this->extractToken($authentification, "js_time"),
                "timezone_field" => "+02|00",
                "client_id" => 578134,
                "redirect_uri" => "http://web.skype.com/"
            );
            $authentification = $this->web("https://login.skype.com/login?client_id=578134&redirect_uri=https%3A%2F%2Fweb.skype.com", "POST", $tokens, true);

            preg_match('`<input type="hidden" name="skypetoken" value="(.+)"/>`isU', $authentification, $skypeToken);
            if (isset($skypeToken[1])) {
                $skypeToken = $skypeToken[1];
                $this->login($skypeToken);
            } else {
                trigger_error("Skype ($skypeUsername) : Authentication failed line ".__LINE__, E_USER_WARNING);
                exit;
            }
        } else {
            $this->skypeToken = $tokens[0];
            $this->registrationToken = $tokens[1];
            $this->username = $skypeUsername;
        }
    }

    /**
     * extractToken
     *
     * Extract tokens from a Skype login page
     * $page -> html code with the tokens
     * $nom -> name of the token
     */
    private function extractToken($page, $nom) {
        preg_match('`<input type="hidden" name="'.$nom.'" id="'.$nom.'" value="(.+)"/>`isU', $page, $resultat);

        return isset($resultat[1]) ? $resultat[1] : false;
    }

    /**
     * web
     *
     * Creates a web request with cURL
     * $url -> url for the request
     * $mode -> method of the request
     * $post -> post data (optional)
     * $showHeaders -> display or not the response headers
     * $suivre -> follow redirects
     * $headers -> send custom headers or not
     */
    public function web($url, $mode = "GET", $post = null, $showHeaders = false, $suivre = true, $headers = null) {
        if (!function_exists("curl_init")) exit("cURL not found\nIf Debian, type 'apt-get install php5-curl'\n");

        if (isset($this->registrationToken) && isset($this->skypeToken)) {
            if (!isset($headers) or !is_array($headers)) {
                $headers = Array();
            }
            $headers = Array("X-Skypetoken: {$this->skypeToken}", "RegistrationToken: registrationToken={$this->registrationToken}", "Content-Length: ".strlen($post), "Content-Type: application/x-www-form-urlencoded");
        }

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        if (!is_null($headers)) curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $mode);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_HEADER, $showHeaders);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $suivre);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $resultat = curl_exec($curl);

        curl_close($curl);

        return $resultat;
    }

    /**
     * timestamp
     *
     * Return current timestamp
     */
    private function timestamp() {
        return str_replace(".", "", microtime(1));
    }

    /**
     * login
     *
     * Creates a "RegistrationToken"
     * $skypeToken -> your skypeToken
     */
    public function login($skypeToken) {
        $this->skypeToken = $skypeToken;
        $authentification = $this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/endpoints", "POST", "{}", true, true, Array("Authentication: skypetoken=$skypeToken"));

        preg_match('`registrationToken=(.+);`isU', $authentification, $registrationToken);
        if (isset($registrationToken[1])) {
            $registrationToken = $registrationToken[1];
            $this->registrationToken = $registrationToken;

            file_put_contents("{$this->cacheDir}/{$this->username}", "{$this->skypeToken}|{$this->registrationToken}|".(time()+86400));
            $this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/endpoints/SELF/subscriptions", "POST", '{"channelType":"httpLongPoll","template":"raw","interestedResources":["/v1/users/ME/conversations/ALL/properties","/v1/users/ME/conversations/ALL/messages","/v1/users/ME/contacts/ALL","/v1/threads/ALL"]}');

            return true;
        } else {
            trigger_error("Skype ($skypeUsername) : Authentication failed line ".__LINE__, E_USER_WARNING);
            exit;
        }
    }

    /**
     * logout
     *
     * Destroys your RegistrationToken and the cache from SkypePHP for the logged user
     */
    public function logout() {
        unlink("{$this->cacheDir}/{$this->username}");
        unset($this->registrationToken);

        return true;
    }

    /**
     * URLtoUser
     *
     * Convert a Skype conversation URL to the name of the user
     * $url -> conversation url
     */
    public function URLtoUser($url) {
        return str_replace("https://db3-client-s.gateway.messenger.live.com/v1/users/ME/contacts/", "", str_replace("8:", "", str_replace("19:", "", $url)));
    }

    /**
     * sendMessage
     *
     * Send a message
     * $user -> username of the recipient
     * $message -> message to send
     */
    public function sendMessage($user, $message) {
        $user = $this->URLtoUser($user);
        $cMode = (strstr($user, "@thread.skype") ? 19 : 8);
        $messageID = $this->timestamp();
        $req = json_decode($this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/conversations/$cMode:$user/messages", "POST", json_encode(Array("content" => $message, "messagetype" => "RichText", "contenttype" => "text", "clientmessageid" => $messageID))), true);

        return isset($req["OriginalArrivalTime"]) ? $messageID : false;

    }

    /**
     * send message
     * @param $user
     * @param $message
     * @return mixed
     */
    public function sm($user, $message){
        $cMode = (strstr($user, "@thread.skype") ? 19 : 8);
        $re = json_decode($this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/conversations/$cMode:$user/messages","POST",json_encode(array("contenttype"=>"text","messagetype" => "Text","content"=>$message))));
        return $re;
    }

    /**
     * getMessagesList
     *
     * Get messages from a conversation
     * $user -> username of the recipient
     * $size -> number of messages to display (min: 1, max: 199)
     */
    public function getMessagesList($user, $size = 100) {
        $user = $this->URLtoUser($user);
        if ($size > 199 or $size < 1) $size = 199;
        $cMode = (strstr($user, "@thread.skype") ? 19 : 8);
        $req = json_decode($this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/conversations/$cMode:$user/messages?startTime=0&pageSize=$size&view=msnp24Equivalent&targetType=Passport|Skype|Lync|Thread"), true);

        return (!isset($req["message"]) ? $req : false);
    }

    /**
     * createGroup
     *
     * Create a group
     * $usersArray -> must contain an array with the users to add
     */
    public function createGroup($usersArray) {
        if (is_array($usersArray)) {

            foreach ($usersArray as $user) {
                $members["members"][] = Array("id" => "8:".$this->URLtoUser($user), "role" => "User");
            }

            $members["members"][] = Array("id" => "8:{$this->username}", "role" => "Admin");

            $this->web("https://client-s.gateway.messenger.live.com/v1/threads", "POST", json_encode($members), true);
            return true;
        } else {
            trigger_error("Skype ({$this->username}) : ".__FUNCTION__." -> the group members list is not an Array", E_USER_WARNING);
            return false;
        }
    }

    /**
     * getGroupInfo
     *
     * Gets the group information
     * $group -> the group username
     */
    public function getGroupInfo($group) {
        $req = json_decode($this->web("https://client-s.gateway.messenger.live.com/v1/threads/19:$group?view=msnp24Equivalent", "GET"), true);

        return (!isset($req["code"]) ? $req : false);
    }

    /**
     * addUser
     *
     * Adds a user to a group
     * $group -> the group username
     * $user -> username to add
     */
    public function addUser($group, $user) {
        $user = $this->URLtoUser($user);

        $req = $this->web("https://client-s.gateway.messenger.live.com/v1/threads/19:$group/members/8:$user", "PUT");

        return (empty($req) ? true : false);
    }

    /**
     * kickUser
     *
     * Kick a user from a group (if you can)
     * $group -> the group username
     * $user -> username to kick
     */
    public function kickUser($group, $user) {
        $user = $this->URLtoUser($user);

        $req = json_decode($this->web("https://client-s.gateway.messenger.live.com/v1/threads/19:$group/members/8:$user", "DELETE"), true);

        return (empty($req) ? true : false);
    }

    /**
     * leaveGroup
     *
     * Exits a group
     * $group -> the group username
     */
    public function leaveGroup($group) {
        $req = $this->kickUser($group, $this->username);

        return ($req ? true : false);
    }

    /**
     * ifGroupHistoryDisclosed
     *
     * Choose if the history of a group is disclosed or not (if you can)
     * $historydisclosed -> "true" or "false"
     */
    public function ifGroupHistoryDisclosed($group, $historydisclosed) {
        $req = $this->web("https://client-s.gateway.messenger.live.com/v1/threads/19:$group/properties?name=historydisclosed", "PUT", json_encode(Array("historydisclosed" => $historydisclosed)));

        return (empty($req) ? true : false);
    }

    /**
     * getContactsList
     *
     * Gets your contact list
     */
    public function getContactsList() {
        $req = $this->web('https://contacts.skype.com/contacts/v1/users/'.$this->username.'/contacts?$filter=type%20eq%20%27skype%27%20or%20type%20eq%20%27msn%27%20or%20type%20eq%20%27pstn%27%20or%20type%20eq%20%27agent%27&reason=default');
        $contacts = json_decode($req, true);

        return isset($contacts["contacts"]) ? $contacts["contacts"] : false;
    }


    /**
     * readProfile
     *
     * Reads the profile of someone
     * $list -> list of users. Example : $list = Array("echo123", "test1", "test2")
     */
    public function readProfile($list) {
        $contacts = "";
        foreach ($list as $out) $contacts .= "contacts[]=$out&";
        $req = $this->web("https://api.skype.com/users/self/contacts/profiles", "POST", $contacts);
        $data = json_decode($req, true);

        return !empty($data) ? $data : false;
    }

    /**
     * readMyProfile
     *
     * Reads your profile
     */
    public function readMyProfile() {
        $req = $this->web("https://api.skype.com/users/self/profile");
        $data = json_decode($req, true);

        return !empty($data) ? $data : false;
    }

    /**
     * searchSomeone
     *
     * Search someone on the Skype network
     * $username -> what his username looks
     */
    public function searchSomeone($username) {
        $req = $this->web("https://api.skype.com/search/users/any?keyWord=$username&contactTypes[]=skype");
        $data = json_decode($req, true);

        return !empty($data) ? $data : false;
    }

    /**
     * addContact
     *
     * Adds someone to your contacts list
     * $username -> the username of the contact to add
     */
    public function addContact($username, $greeting = "Hello, I would like to add you to my contacts.") {
        $req = $this->web("https://api.skype.com/users/self/contacts/auth-request/$username", "PUT", "greeting=$greeting");
        $data = json_decode($req, true);

        return (isset($data["code"]) && $data["code"] == 20100 ? true : false);
    }

    /**
     * getNews
     *
     * Gets notifications of your account. Does not work properly
     */
    public function getNews() {
        // buggy

        if (time()-$this->lastPoll >= 10) {
            $this->logout();
            $this->login($this->skypeToken);
        }

        $this->lastPoll = time();

        $req = $this->web("https://client-s.gateway.messenger.live.com/v1/users/ME/endpoints/SELF/subscriptions/0/poll", "POST");
        $data = json_decode($req, true);

        return $data;
    }
}
