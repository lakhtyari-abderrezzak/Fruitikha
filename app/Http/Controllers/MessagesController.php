<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $messages = Message::all();
        return view('about', compact('messages'));
    }
}
