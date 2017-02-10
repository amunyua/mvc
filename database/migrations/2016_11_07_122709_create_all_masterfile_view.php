<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAllMasterfileView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::statement(
//            "CREATE OR REPLACE VIEW all_masterfiles AS
//            select m.id,
//            concat(m.surname,' ',m.firstname,' ',m.middlename) as username,
//            m.id_no,
//            m.image_path,
//            m.user_role,
//            ct.created_at,
//            ct.city,
//            ct.postal_address,
//            ct.physical_address,
//            ct.email,
//            ct.phone_number
//            from masterfiles m
//            LEFT JOIN contacts ct ON ct.masterfile_id = m.id"
//        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(
            "DROP VIEW all_masterfiles
           "
        );
    }
}
