<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Validator;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
   public function sendMessage(Request $request)
   {
       $validator = Validator::make($request->all(), ContactMessage::$rules);
       if ($validator->fails()) {
           return redirect('/contact')
               ->withErrors($validator)
               ->withInput();
       }
       ContactMessage::storeMessage($request->all());
       $request->session()->flash('status', 'Task was successful!');
       return redirect()->back();
   }
}
