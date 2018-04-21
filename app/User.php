<?php

namespace App;

use App\Models\Order;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'bank_account'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'sometimes|confirmed|string|min:6'
        ];
    }

    public function getRoles()
    {
        $data = DB::table('role_user')->select('role_id')->where('user_id', $this->id)->get()->pluck('role_id')->toArray();
        $roles = [];
        foreach ($data as $role_id) {
            $roles[$role_id] = Role::getName($role_id);
        }
        return $roles;
    }

    public static function getTraders()
    {
        $data = Order::select('user_id')->get()->toArray();
        $user_ids = array_unique(array_flatten($data));

        $users = static::whereIn('id', $user_ids)->select('id', 'name')->get();
        $traders = [];

        foreach ($users as $user) {
            $traders[$user->id] = $user->name;
        }
        return $traders;
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
