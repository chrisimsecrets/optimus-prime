<?php

namespace App\Http\Controllers;

use App\FacebookPages;
use App\Sender;
use App\SlackBot;
use Facebook\Facebook;
use Facebook\HttpClients\FacebookGuzzleHttpClient;
use Illuminate\Http\Request;

class Hook extends Controller
{
    /**
     * @param Request $re
     * @return mixed
     * web hook for facebook chat bot ( old )
     */
    public function fb(Request $re)
    {


        $challenge = $re->hub_challenge;
        $verify_token = $re->hub_verify_token;

        if ($verify_token === 'optimus') {
            return $challenge;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $sender = (isset($input['entry'][0]['messaging'][0]['sender']['id'])) ? $input['entry'][0]['messaging'][0]['sender']['id'] : "";


        $question = isset($input['entry'][0]['messaging'][0]['message']['text']) ? $input['entry'][0]['messaging'][0]['message']['text'] : "nothing";
        $mid = isset($input['entry'][0]['messaging'][0]['message']['mid']) ? $input['entry'][0]['messaging'][0]['message']['mid'] : '';
        $pageId = isset($input['entry'][0]['id']) ? $input['entry'][0]['id'] : '';

        $token = Data::getToken($pageId);
        $url = 'https://graph.facebook.com/v2.6/me/messages?access_token=' . $token;
        $ch = curl_init($url);
        if ($question != 'nothing') {
            $msg = ChatBotController::compile($question, $pageId);

        } else {
            $msg = Data::getExceptionMessage($pageId);

        }


        $jsonData = '{
                        "recipient":{
                        "id":"' . $sender . '"
                        },
                        "message":{
                        "text":"' . $msg . '"
                        }
                        }';

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
//        Prappo::notify("title", "good", "http://google.com", "cool", "2432432");

//Execute the request but first check if the message is not empty.
        $time = "";
        if (!empty($input['entry'][0]['messaging'][0]['message'])) {
            $result = curl_exec($ch);
            $timestamp = $input['entry'][0]['time'];
            $timestamp = 1465298940;
            $datetimeFormat = 'Y-m-d H:i:s';

            $date = new \DateTime();
            $date->setTimestamp($timestamp);
            $time = $date->format($datetimeFormat);
            try {
                $pageName = Data::getPageName($pageId);
            } catch (\Exception $e) {
                $pageName = "";
            }

//            Prappo::notify(($pageName != "") ? $pageName . ' Message' : 'Message', $question, url('/') . '/conversations/message/' . $pageId . '/m_' . $mid, 'message', $time);
        } else {

            if (isset($input['entry'][0]['changes'][0]['feed'])) {
//                Prappo::notify('Notification', "You got a facebook notification", 'https://facebook.com/', 'fbnotify', $time);
            }

            $timestamp = $input['entry'][0]['time'];
            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($timestamp);
            $time = $date->format($datetimeFormat);
//            Prappo::notify('Notification', "You got a facebook notification", 'https://facebook.com/', 'fbnotify', $time);
        }

    }

    /**
     *
     * Web hook for Slack Bot
     * @param Request $request
     * @return null|string
     */

    public function slack(Request $request)
    {
        if ($request->user_name === 'slackbot') {
            return null;
        }

        $messages = SlackBot::where('channel', '#' . $request->channel_name)->get();

        $defaultAccuracy = Data::get('slackBotMatchAcc');

        $text = '';

        foreach ($messages as $message) {
            $questions = preg_split("/,/", $message->question);

            foreach ($questions as $question) {
                similar_text(strtolower(trim($question)), strtolower(trim($request->text)), $accuracy);

                if (($message->accuracy !== '' && $accuracy >= $message->accuracy)
                    || $accuracy >= $defaultAccuracy
                ) {
                    $text = "<@{$request->user_name}> {$message->answer}";
                }
            }
        }

        $response = [
            'text' => $text
        ];

        return stripslashes(json_encode($response));
    }

    /**
     *
     *
     * Web hook for facebook bot
     * @param Request $request
     * @return mixed
     */
    public function facebook(Request $request){
        $challenge = $request->hub_challenge;
        $verify_token = $request->hub_verify_token;

        if ($verify_token === 'optimus') {
            return $challenge;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        Hook::now($input);
    }

    public static function now($input)
    {
        $pageId = $input['entry'][0]['id'];
        $message = isset($input['entry'][0]['changes'][0]['value']['message']) ? $input['entry'][0]['changes'][0]['value']['message'] : "";
        $sender_name = isset($input['entry'][0]['changes'][0]['value']['sender_name']) ? $input['entry'][0]['changes'][0]['value']['sender_name'] : null;
        $sender_id = isset($input['entry'][0]['changes'][0]['value']['sender_id']) ? $input['entry'][0]['changes'][0]['value']['sender_id'] : null;

        /*
         * Detect Comments and reply to comment
         *
         * */
        if (isset($input['entry'][0]['changes'][0]['value']['comment_id']) && isset($input['entry'][0]['changes'][0]['value']['sender_id'])) {


            $postId = isset($input['entry'][0]['changes'][0]['value']['post_id']) ? $input['entry'][0]['changes'][0]['value']['post_id'] : "";
            $item = isset($input['entry'][0]['changes'][0]['value']['item']) ? $input['entry'][0]['changes'][0]['value']['item'] : null;
            $verb = isset($input['entry'][0]['changes'][0]['value']['verb']) ? $input['entry'][0]['changes'][0]['value']['verb'] : null;
            $field = isset($input['entry'][0]['changes'][0]['field']) ? $input['entry'][0]['changes'][0]['field'] : null;
            $fbPostId = isset($input['entry'][0]['changes'][0]['value']['parent_id']) ? $input['entry'][0]['changes'][0]['value']['parent_id'] : "";


            /*
             *
             * Save notification
             *
             * */

            if ($verb != null && $item != null) {
                if ($verb == "remove") {
                    $content = "A $item has been removed form your page " . SettingsController::getPageName($pageId) . " and post ID <a target='_blank' href='http://facebook.com/$fbPostId'><kbd>$fbPostId</kbd></a>";
                    NotificationController::notify($verb, $content, $item);
                } elseif ($verb == "edited") {

                    $content = "$sender_name  edited his comment on a post and post ID <a target='_blank' href='http://facebook.com/$fbPostId'><kbd>$fbPostId</kbd></a> and page Name " . SettingsController::getPageName($pageId) . " ";
                    NotificationController::notify($verb, $content, $item);

                } elseif ($verb == "add") {
                    if ($item == "comment") {

                        $content = "$sender_name commented on your page " . SettingsController::getPageName($pageId) . " and post ID <a target='_blank' href='http://facebook.com/$fbPostId'><kbd>$fbPostId</kbd></a>";
                        NotificationController::notify($verb, $content, $item);
                    }
                }


            }


            if (!FacebookPages::where('pageId', $input['entry'][0]['changes'][0]['value']['sender_id'])->exists()) {
                /*
                check if sender already exists otherwise insert sender information
                */
                if (!Sender::where('sender_id', $sender_id)->exists()) {
                    $sender = new Sender();
                    $sender->sender_name = $sender_name;
                    $sender->sender_id = $sender_id;
                    $sender->save();
                }

                /*
                 * check if this is message and reply it
                 *
                 * */
                if (isset($input['entry'][0]['changes'][0]['value']['message'])) {
                    $fbObject = new Facebook([
                        'app_id' => SettingsController::get('fbAppId'),
                        'app_secret' => SettingsController::get('fbAppSec'),
                        'default_graph_version' => 'v2.6'
                    ]);

                    $facebook = $fbObject;
                    $commentId = $input['entry'][0]['changes'][0]['value']['comment_id'];
                    $parentId = $input['entry'][0]['changes'][0]['value']['parent_id'];
                    $explodePostId = explode("_", $fbPostId);
                    $pId = $explodePostId[0];


                    try {
                        /*
                         * If spam Defender is on
                         *
                         * */


                        if ($item == 'comment' && $verb == 'add') {
                            if (SettingsController::get('spamDefender') == "on") {
                                /*
                             * Detect Black listed words
                             *
                             * */

                                if (SettingsController::get('autoDelete') == "on") {
                                    if (SettingsController::get('words') != "") {
                                        $words = explode(',', SettingsController::get('words'));
                                        foreach ($words as $word) {
                                            if (strpos(strtolower($message), strtolower($word)) !== false) {

                                                $spam = new Spam();
                                                $spam->content = $message;
                                                $spam->save();

                                                $facebook->delete($commentId, [], SettingsController::getPageToken($pageId));
                                                exit;
                                            }
                                        }
                                    }


                                    /*
                                     * Detect URLs
                                     *
                                     * */

                                    if (SpamController::isUrl($message)) {
                                        if (SettingsController::get('urls') != "") {
                                            $urls = explode(',', SettingsController::get('urls'));
                                            foreach ($urls as $url) {
                                                if (strpos(strtolower($message), strtolower($url)) !== false) {

                                                } else {

                                                    $spam = new Spam();
                                                    $spam->content = $message;
                                                    $spam->save();

                                                    $facebook->delete($commentId, [], SettingsController::getPageToken($pageId));
                                                    exit;
                                                }
                                            }
                                        } else {

                                            $spam = new Spam();
                                            $spam->content = $message;
                                            $spam->save();

                                            $facebook->delete($commentId, [], SettingsController::getPageToken($pageId));
                                            exit;
                                        }
                                    }


                                } else {

                                    /*
                                     * Log the spams
                                     * */

                                    if (SettingsController::get('words') != "") {
                                        $words = explode(',', SettingsController::get('words'));
                                        foreach ($words as $word) {
                                            if (strpos(strtolower($message), strtolower($word)) !== false) {
                                                $spam = new Spam();
                                                $spam->content = $message;
                                                $spam->save();
                                            }
                                        }
                                    }


                                    /*
                                     * Detect URLs
                                     *
                                     * */

                                    if (SpamController::isUrl($message)) {
                                        if (SettingsController::get('urls') != "") {
                                            $urls = explode(',', SettingsController::get('urls'));
                                            foreach ($urls as $url) {
                                                if (strpos(strtolower($message), strtolower($url)) !== false) {

                                                } else {
                                                    $spam = new Spam();
                                                    $spam->content = $message;
                                                    $spam->save();
                                                }
                                            }
                                        } else {
                                            $spam = new Spam();
                                            $spam->content = $message;
                                            $spam->save();
                                        }
                                    }
                                }

                                /*
                                 * Action if comments are not spam
                                 *
                                 * */

                                foreach (Comments::where('pageId', $pageId)->get() as $comment) {

                                    similar_text(strtolower($message), strtolower($comment->question), $match);
                                    if ($match >= SettingsController::get('match')) {
                                        echo "Matching " . $match;
                                        if ($comment->specified == "yes") {
                                            if ($comment->postId != $postId) {
                                                echo "Comment matches but postID didn't match post ID $postId";
                                                /*
                                                 * Exception Message
                                                 *
                                                 * */
                                                try {
                                                    // trying to comment

                                                    $facebook->post($commentId . '/comments', ['message' => SenderController::processText(FacebookPages::where('pageId', $pageId)->value('exceptionMessage'), $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                                    echo __FILE__ . "[ " . __LINE__ . " ] ";

                                                } catch (\Exception $exception) {
                                                    // trying to reply
                                                    echo __FILE__ . "[ " . __LINE__ . " ] ";
                                                    $facebook->post($parentId . '/comments', ['message' => SenderController::processText(FacebookPages::where('pageId', $pageId)->value('exceptionMessage'), $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                                }
                                                exit;
                                            }
                                        }
                                        /*
                                         * If this is for public comment
                                         *
                                         * */
                                        if ($comment->type == "public") {
                                            echo "This is public comment ";
                                            /*
                                             * trying to reply
                                             *
                                             * */

                                            try {
                                                if ($comment->link != 'no') {
                                                    // comment with image

                                                    $facebook->post($commentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message), 'attachment_url' => $comment->link], SettingsController::getPageToken($pageId));


                                                } else {
                                                    // comment without image

                                                    $facebook->post($commentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));

                                                }
                                                exit;


                                            } catch (\Exception $exception) {

                                                /*
                                                * If can't reply then try to reply via parent ID
                                                *
                                                * */

                                                try {
                                                    if ($comment->link != 'no') {
                                                        // comment with image

                                                        $facebook->post($parentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message), 'attachment_url' => $comment->link], SettingsController::getPageToken($pageId));

                                                    } else {
                                                        // comment without image

                                                        $facebook->post($parentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));

                                                    }
                                                    exit;

                                                } catch (\Exception $exception) {

                                                    if ($comment->link != 'no') {
                                                        $facebook->post($parentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message), 'attachment_url' => $comment->link], SettingsController::getPageToken($pageId));
                                                    } else {
                                                        $facebook->post($parentId . '/comments', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                                    }

                                                    exit;
                                                }


                                            }
                                        } elseif ($comment->type == "private") {

                                            echo "\n Repling private message \n";

                                            try {
                                                $response = $facebook->post($commentId . '/private_replies', ['message' => SenderController::processText($comment->answer, $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                                print_r($response->getDecodedBody());
                                            } catch (\Exception $exception) {
                                                return $exception->getMessage();
                                            }


                                            exit;
                                        }


                                    }
                                }

                                echo "Going to send exception message";

                                /*
                                 * Exception Message
                                 *
                                 * */
                                try {
                                    // trying to comment

                                    $facebook->post($commentId . '/comments', ['message' => SenderController::processText(FacebookPages::where('pageId', $pageId)->value('exceptionMessage'), $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                    echo __FILE__ . "[ " . __LINE__ . " ] ";

                                } catch (\Exception $exception) {
                                    // trying to reply
                                    echo __FILE__ . "[ " . __LINE__ . " ] ";
                                    $facebook->post($parentId . '/comments', ['message' => SenderController::processText(FacebookPages::where('pageId', $pageId)->value('exceptionMessage'), $sender_name, $pageId, $message)], SettingsController::getPageToken($pageId));
                                }

                                echo "Exception message Done";

                                exit;
                            }


                        } else {

                            /*
                             * If spam defender is not on
                             *
                             * */
                        }


                    } catch (\Exception $exception) {


                    }
                }
            }


        }


        /*
         * Messaging
         *
         * */


        $sender = isset($input['entry'][0]['messaging'][0]['sender']['id']) ? $input['entry'][0]['messaging'][0]['sender']['id'] : null;
        $message = isset($input['entry'][0]['messaging'][0]['message']['text']) ? $input['entry'][0]['messaging'][0]['message']['text'] : "nothing";

        if (!empty($input['entry'][0]['messaging'][0]['message']) || isset($input['entry'][0]['messaging'][0]['postback']['payload'])) {

            foreach (Messages::where('pageId', $pageId)->get() as $msg) {

                similar_text(strtolower($message), strtolower($msg->question), $match);
                if ($match >= SettingsController::get('match')) {
                    if ($msg->answer != null || $msg->answer != "") {
                        self::fire(SenderController::sendMessage($sender, SenderController::processText($msg->answer, $sender_name, $pageId, $message)), $pageId);
                    }
                    if ($msg->image != null || $msg->image != "") {
                        self::fire(SenderController::sendImage($sender, $msg->image), $pageId);
                    }
                    if ($msg->video != null || $msg->video != "") {
                        self::fire(SenderController::sendVideo($sender, $msg->video), $pageId);
                    }
                    if ($msg->audio != null || $msg->audio != "") {
                        self::fire(SenderController::sendAudio($sender, $msg->audio), $pageId);
                    }
                    if ($msg->file != null || $msg->file != "") {
                        self::fire(SenderController::sendFile($sender, $msg->file), $pageId);
                    }

                    exit;
                }

            }
            self::fire(SenderController::sendMessage($sender, SenderController::processText(FacebookPages::where('pageId', $pageId)->value('exceptionMessage'), $sender_id, $sender_name, $message)), $pageId);
        }


    }

}
