<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        try {
            //return 'Telegram Api Test';

//        $users = DB::table('users')->select('name', 'email as user_email')->get();
//        $users = DB::table('users')->get();

            $Notifications = DB::table('notification')->where('IsSendToTelegram', 0)->limit(10)->get();

            $Text = '';
            $UserName = '';
            $NewLine = chr(10);
            $Telegram = new TelegramBotPhpController();
            $NotificationIdes = [];

            foreach ($Notifications as $notification){
                //$User = User::find($notification->userid);
                $User = DB::table('userdetails')->where('userid', $notification->userid)->first();

                //if (! isset($User)) continue;
                if (! isset($User) or $UserName == '') {
                    $User = User::find($notification->userid);
                    if (! isset($User)) continue;
                    $UserName = $User->display_name;
                }else{
                    $UserName = $User->firstname . ' ' . $User->lastname;
                }

                $Text .= 'Dear ' . $UserName . $NewLine;
                $Text .= $notification->details . $NewLine;

                $Telegram->SendTextMessage_TestChannel($Text);

                $Text = '';

                //$notification->update(['IsSendToTelegram' => 1]);

                //$notification->IsSendToTelegram = 1;
                //$notification->save();

                $NotificationIdes[] = $notification->id;

            }

            //$Notifications->update(['IsSendToTelegram' => 1]);

            $Notifications = DB::table('notification')->whereIn('id', $NotificationIdes)->update(['IsSendToTelegram' => 1]);

            //return $Notifications->count();
            return 'Message Send Count:  ' . $Notifications;

        } catch (\Exception $ex) {
            return 'Error: ' . $ex->getMessage();
            //return '';
        }

    }

    public function GetGroupID()
    {

//        $Telegram = new TelegramBotPhpController();
//        return $Telegram->GetGroupID();

        return '';
    }



}
