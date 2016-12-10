<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\chatbot;
use App\SlackBot;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function fb()
    {
        $data = chatbot::where('userId', Auth::user()->id)->get();

        return view('fbbot', compact('data'));
    }

    public function slack()
    {
        $data = SlackBot::where('userId', Auth::user()->id)->get();

        return view('slackbot', compact('data'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function addQuestion(Request $re)
    {
        /** @var string $question */
        $question = $re->question;
        /** @var string $answer */
        $answer = $re->answer;

        if ($question == "") {
            return "Write some question ";
        }

        if ($answer == "") {
            return "Write question's answer";
        }
        try {
            $data = new chatbot();
            $data->question = $question;
            $data->answer = $answer;
            $data->pageId = $re->pageId;
            $data->userId = Auth::user()->id;
            $data->save();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param Request $re
     * @return string
     */
    public function delQuestion(Request $re)
    {
        /** @var int $id */
        $id = $re->id;
        try {
            chatbot::where('id', $id)->where('userId', Auth::user()->id)->delete();
            return "success";
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addSlackQuestion(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
            'channel' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        $channels = [];

        foreach ($request->all() as $field => $value) {
            if ($field === 'channel') {
                $values = preg_split("/,/", $value);

                foreach ($values as $v) {
                    $channels[] = '#' . ltrim(trim($v), '#');
                }
            }
        }

        $questions = [];

        foreach ($channels as $channel) {
            $questions[] = array_merge($request->all(), ['channel' => $channel]);
        }

        SlackBot::insert($questions);

    }

    public function deleteSlackQuestion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        SlackBot::findOrFail($request->id)->delete();
    }

    public function updateBotConfig(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matchAcc' => 'required',
        ]);

        if ($validator->fails()) {
            return 'error';
        }

        Setting::where('userId', Auth::user()->id)->update([
            'slackBotMatchAcc' => $request->matchAcc
        ]);
    }

    /**
     * @param $inputText
     * @param $pageId
     * @return mixed|string
     */
    public static function compile($inputText, $pageId)
    {
        if ($pageId == "") {
            return Data::get('exMsg');
        }
        $per = 0;
        $reply = "";
        $text = chatbot::where('pageId', $pageId)->where('userId', Auth::user()->id)->get();
        foreach ($text as $t) {
            similar_text($t->question, $inputText, $per);
            if ($per >= Data::get('matchAcc')) {
                $reply = $t->answer;
                break;
            } else {
                $reply = Data::get('exMsg');
            }
        }
        return $reply;
    }
}
