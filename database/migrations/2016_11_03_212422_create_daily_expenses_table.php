<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_expenses', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->integer('transaction_id')->unsigned()->index();
            $table->foreign('transaction_id')
                ->references('id')
                ->on('daily_transactions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('expense_id')->unsigned()->index();
            $table->foreign('expense_id')
                ->references('id')
                ->on('expenses')
                ->onUpdate('cascade');
            $table->double('amount');
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
        Schema::dropIfExists('daily_expenses');
    }
}
