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
        if (!Schema::hasTable('menus')) {
            Schema::create('menus', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('parent_id')->unsigned()->nullable()->index()->foreign()->references('id')->on('menus');
                $table->string('label', 50);
                $table->string('slug', 100)->nullable();
                $table->string('icon', 50)->nullable();
                $table->string('role', 100)->nullable();
                $table->integer('weight')->default(0);
                $table->boolean('enabled')->default(true);
                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('menus');
    }
}
