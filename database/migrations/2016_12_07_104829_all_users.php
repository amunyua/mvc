<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //all users view
        DB::statement(
            "CREATE OR REPLACE VIEW all_users AS
              SELECT u.id,
                u.name,
                r.role_name,
                u.status,
                ru.user_id
              FROM users u
                LEFT JOIN role_user ru ON ru.user_id = u.id
                LEFT JOIN roles r ON r.id = ru.role_id"
        );
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
