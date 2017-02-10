<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id')->unique();
            $table->string('route_name');
            $table->integer('parent_route')->unsigned()->nullable();
            $table->index('parent_route');
            $table->string('url')->nullable();
            $table->boolean('route_status')->default(1);
            $table->timestamps();
        });

        Schema::table('routes', function (Blueprint $table) {
            $table->foreign('parent_route')
                ->references('id')
                ->on('routes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
}
