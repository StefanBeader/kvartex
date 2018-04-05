<?php

use Illuminate\Database\Migrations\Migration;

class InsertUserStefanWithAdminRights extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Stefan Beader',
                'email' => 'stefan_beader@yahoo.com',
                'password' => '$2y$10$b6B9pOL/e6sj3X8i6RrTMu4fmHiCGveyixFecIWQsbNOFO/9tCk6S',
                'bank_account' => '',
                'can_trade' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'Test User',
                'email' => 'test@user.com',
                'password' => '$2y$10$b6B9pOL/e6sj3X8i6RrTMu4fmHiCGveyixFecIWQsbNOFO/9tCk6S',
                'bank_account' => '',
                'can_trade' => 1,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]
        ]);

        \Illuminate\Support\Facades\DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => '',
            ]
        ]);

        \Illuminate\Support\Facades\DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
