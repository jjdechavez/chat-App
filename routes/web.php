<?php

use App\Message;

Route::get('/', function () {
    return view('welcome');
});

// retrun all message
Route::get('/getAll', function(){
    $message = Message::take(200)->pluck('content');
    return $message;
});

// Post new message
Route::post('/post', function(){
    $message = new Message();
    $content = request('message');
    $message->content = $content;
    $message->save();

    event(new MessageSent($content));

    return $content;
});