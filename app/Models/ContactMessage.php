<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;

class ContactMessage extends Model
{
    protected $guarded = [];

    public static $rules = [
      'name' => 'required|string|max:256',
      'email' => 'required|email|max:256',
      'message' => 'required|string|max:512',
    ];

    public static function storeMessage(array $message)
    {
        static::create($message);
    }
}
