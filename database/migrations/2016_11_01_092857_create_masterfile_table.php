<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterfiles', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename');
            $table->text('image_path')->nullable();
            $table->string('user_role')->nullable();
            $table->string('id_no');
            $table->date('registration_date')->nullable();
            $table->integer('depends_on')->index()->nullable();
            $table->string('b_role', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('masterfile');
    }
}
