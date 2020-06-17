<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShortcutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('shortcuts')) {
            Schema::create('shortcuts', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id')->unsigned()->nullable()->index()->foreign()->references('id')->on('users'); // nullable just for seed
                $table->string('widget_id');
                $table->string('name');
                $table->string('URL');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shortcuts');
    }
}
