<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', 'HomeController@index');

//------------------------------------------------------

Route::get('/TelegramBotPhp/SetWebhook/{bot_id}' , 'TelegramBotPhpController@SetWebhook');
Route::get('/TelegramBotPhp/RemoveWebhook/{bot_id}' , 'TelegramBotPhpController@RemoveWebhook');
Route::get('/TelegramBotPhp/GetGroupID/{bot_id}' , 'TelegramBotPhpController@GetGroupID');

Route::get('/TelegramBotPhp/SendTextMessage_TestChannel/{text}' , 'TelegramBotPhpController@SendTextMessage_TestChannel');
