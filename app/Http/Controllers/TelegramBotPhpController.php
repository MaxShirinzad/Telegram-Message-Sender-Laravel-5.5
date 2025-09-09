<?php

namespace App\Http\Controllers;


use App\User;

use Illuminate\Http\Request;

use App\Http\Controllers\TelegramBotPhp\Telegram;


class TelegramBotPhpController extends Controller
{
    public function SetWebhook($bot_id)
    {
        try {
            $url = url('/TelegramBotPhp/WebhookHandler/' . $bot_id);

            $telegram = new Telegram($bot_id);
            //            $url = url('/TelegramBotPhp/TeleBotTest' . TelegramBotToken_IrBord_bot());
            return $telegram->setWebhook($url);

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function RemoveWebhook($bot_id)
    {
        try {
//            $bot_id = TelegramBotToken_Shahrbord_Tehran_bot();PHP_EOL
            //--------------------------------
            $telegram = new Telegram($bot_id);
            return $telegram->deleteWebhook();

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function SendTextMessage($bot_id, $chat_id, $text, $disable_web_page_preview = false, $ReturnMessageID = false)
    {
        try {
            //            $bot_id = TelegramBotToken_IrBord_bot();
            $telegram = new Telegram($bot_id);

//            $content = array('chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML');
            $content = array('chat_id' => $chat_id, 'text' => $text, 'parse_mode' => 'HTML', 'disable_web_page_preview' => $disable_web_page_preview);
//            $content = array('chat_id' => $chat_id, 'text' => $text);
            //------------------------------
            $result = $telegram->sendMessage($content);

            if ($ReturnMessageID){
                $message_id = $result['result']['message_id'];

                if ($message_id == null) return '';

                return $message_id;

            }

            return $result;


        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }


    public function SendTextMessage_TestChannel($text)
    {
        try {
            //            $bot_id = '111111111:aaaaaaaaaaaaaaa'; // @Talabord1_bot
            //            $chat_id = '-111111111111111111111'; // TestChannel

            $bot_id = '222222222:bbbbbbbbbbbbbbb';
            $chat_id = '-222222222222222222';

            $text = '<b>' . $text . '</b>';

            $message_id = $this->SendTextMessage($bot_id, $chat_id, $text,false,true);

//            if ($message_id == null) return '';
            return $message_id;

        } catch (\Exception $ex) {
//            return $ex->getMessage();
            return '';
        }

    }

    public function GetGroupID($bot_id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            //---------------------------------------
            //$bot_id = '111111111:aaaaaaaaaaaaaaa'; // @Talabord1_bot

            //$groupID = '-111111111111'; // TestChannel

            $url = ('https://api.telegram.org/bot' . $bot_id . '/getUpdates');
            //---------------------------------------------
            //$url = ('https://api.telegram.org/bot' . $bot_id . '/setWebhook?url=' . url('/'));
            //$url = ('https://api.telegram.org/bot' . $bot_id . '/setWebhook?url=');

            //$url = 'https://www.google.com';
            //---------------------------------------------
            $response = $client->request('GET', $url);
            $response = $response->getBody();

            //        if ($IsJsonDecode) $response = json_decode($response);
            //        if ($ClearHTML) $response = strip_tags($response);

            return $response;

        } catch (\Exception $ex) {
            return $ex->getMessage();
        }

    }







}
