<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id')->uniqie();
            $table->string('menu_name');
            $table->string('icon')->nullable();
            $table->integer('route_id')->unsigned()->index();
            $table->foreign('route_id')
                ->references('id')
                ->on('routes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('parent_menu')->nullable()->unsigned()->index();
            $table->boolean('menu_status')->default('1');
            $table->integer('sequence')->nullable();
            $table->timestamps();

        });
        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('parent_menu')
                ->references('id')
                ->on('menus')
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
        Schema::dropIfExists('menus');
    }
}
