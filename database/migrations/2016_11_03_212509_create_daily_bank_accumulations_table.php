<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyBankAccumulationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_bank_accumulations', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('transaction_id')->unsigned()->index();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('daily_transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->double('total_amount_collected');
            $table->double('bank_expected');
            $table->double('actual_banked');

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
        Schema::dropIfExists('daily_bank_accumilations');
    }
}
