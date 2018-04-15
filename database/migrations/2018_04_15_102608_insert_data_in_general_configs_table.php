<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class InsertDataInGeneralConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('general_configs')->insert(
            [
                'id' => 1,
                'primary_wallet' => 'cex',
                'bank_account' => NULL,
                'min_order_amount' => 5000,
                'max_order_amount' => 100000,
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('general_configs')
            ->where('id', 1)
            ->delete();
    }
}
