<?php

namespace App\Http\Controllers;

use App\SlackBot;
use Facebook\HttpClients\FacebookGuzzleHttpClient;
use Illuminate\Http\Request;

class Hook extends Controller
{
    /**
     * @param Request $re
     * @return mixed
     * web hook for facebook chat bot
     */
    public function fb(Request $re)
    {


        $challenge = $re->hub_challenge;
        $verify_token = $re->hub_verify_token;

        if ($verify_token === 'prappo') {
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
            $msg = Data::get('exMsg');

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
        Prappo::notify("title", "good", "http://google.com", "cool", "2432432");

//Execute the request but first check if the message is not empty.
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

            Prappo::notify(($pageName != "") ? $pageName . ' Message' : 'Message', $question, url('/') . '/conversations/message/' . $pageId . '/m_' . $mid, 'message', $time);
        } else {

            if (isset($input['entry'][0]['changes'][0]['feed'])) {
                Prappo::notify('Notification', "You got a facebook notification", 'https://facebook.com/', 'fbnotify', $time);
            }

            $timestamp = $input['entry'][0]['time'];
            $datetimeFormat = 'Y-m-d H:i:s';
            $date = new \DateTime();
            $date->setTimestamp($timestamp);
            $time = $date->format($datetimeFormat);
            Prappo::notify('Notification', "You got a facebook notification", 'https://facebook.com/', 'fbnotify', $time);
        }

    }

    public function slack(Request $request)
    {
        if ($request->user_name === 'slackbot') {
            return null;
        }

        $messages = SlackBot::where('channel', '#' . $request->channel_name)->get();

        $defaultAccuracy = Data::get('slackBotMatchAcc');

        $text = '';

        foreach ($messages as $message) {
            $questions = explode('|', $message->question);

            foreach ($questions as $question) {
                similar_text(strtolower($question), strtolower($request->text), $accuracy);

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

}
