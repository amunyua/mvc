<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('phone_number');
            $table->integer('created_by')->unsigned()->index();
            $table->foreign('created_by')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade');
            $table->integer('client_group')->unsigned()->index();
            $table->foreign('client_group')
                ->references('id')
                ->on('client_groups')
                ->onUpdate('cascade');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('clients');
    }
}
