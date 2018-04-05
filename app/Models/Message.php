<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    protected $guarded = [];

    public static function countUnreadMessagesFromUser($user_id)
    {
        return static::where('user_id', $user_id)
                        ->where('isRead', false)
                        ->get()
                        ->count();
    }

    public static function setMessagesAsRead($messages_id)
    {
        static::whereIn('id', $messages_id)->update(['isRead' => true]);
    }
}
