<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_transactions', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->date('transaction_date');
            $table->integer('bus_id')->unsigned();
            $table->index('bus_id');
            $table->foreign('bus_id')
                ->references('id')
                ->on('buses')
                ->onUpdate('cascade');
            $table->integer('driver_id')->unsigned()->index();
            $table->foreign('driver_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade');
            $table->integer('conductor_id')->unsigned()->index();
            $table->foreign('conductor_id')
                ->references('id')
                ->on('masterfiles')
                ->onUpdate('cascade');
            $table->double('total_amount_collected');
            $table->double('total_trips');
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
        Schema::dropIfExists('daily_transactions');
    }
}
