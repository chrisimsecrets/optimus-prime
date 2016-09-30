<?php

namespace App\Http\Controllers;

use App\Setting;
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
        $data = chatbot::all();

        return view('fb_bot', compact('data'));
    }

    public function slack()
    {
        $data = SlackBot::all();

        return view('slack_bot', compact('data'));
    }

    /**
     * @param Request $re
     * @return string
     */
    public function addQuestion(Request $re, $bot)
    {
        /** @var string $question */
        $question = $re->question;
        /** @var string $answer */
        $answer = $re->answer;

        try {
            $data = new chatbot();
            $data->question = $question;
            $data->answer = $answer;
            $data->pageId = $re->pageId;
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
            chatbot::where('id', $id)->delete();
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

        SlackBot::create($request->all());
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

        Setting::where('field', 'slackBotMatchAcc')->update([
            'value' => $request->matchAcc
        ]);
    }

    /**
     * @param $inputText
     * @param $pageId
     * @return mixed|string
     */
    public static function compile($inputText, $pageId){
        if($pageId == ""){
            return Data::get('exMsg');
        }
        $per =0;
        $reply = "";
        $text = chatbot::where('pageId',$pageId)->get();
        foreach($text as $t){
            similar_text($t->question,$inputText,$per);
            if($per >= Data::get('matchAcc')){
                $reply = $t->answer;
                break;
            }
            else{
                $reply = Data::get('exMsg');
            }
        }
        return $reply;
    }
}
