<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('chat');
    }
    public function chat(Request $request)
    {
        // バリデーション
        $request->validate([
            'sentence' => 'required',
        ]);

        // 文章
        $sentence = $request->input('sentence');

        // ChatGPT API処理
        // $chat_response = $this->chat_gpt("日本語で応答してください", $sentence);

        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'HTMLもしくはHTML・JavaScriptを使用して'.$sentence.'また、htmlファイルを使用したい',
            'temperature' => 0.8,
            'max_tokens' => 1500,
        ]);

        preg_match('/<html>(.*?)<\/html>/s', $result['choices'][0]['text'], $matches);

        if(!isset($matches[0])){
            $chat_response = $result['choices'][0]['text'];
            return view('chat', compact('sentence', 'chat_response'));
        }
        else{ // HTMLを取得できた場合に表示
            $chat_response = $matches[0];
            return view('sample', compact('sentence', 'chat_response'));
        }

        
    }

    /**
     * ChatGPT API呼び出し
     * cURL
     */
    function chat_gpt($system, $user)
    {
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'HTMLもしくはHTML・JavaScriptを使用して'.$user.'また、htmlファイルを使用したい',
            'temperature' => 0.8,
            'max_tokens' => 1500,
        ]);

        preg_match('/<html>(.*?)<\/html>/s', $result['choices'][0]['text'], $matches);

        if(!isset($matches[0])){
            return $result['choices'][0]['text'];
        }
        else{
            return $matches[0];
        }
    }
}

