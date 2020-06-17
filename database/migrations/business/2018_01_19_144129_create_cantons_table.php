<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCantonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cantons')) {
            Schema::create('cantons', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('province_id')->unsigned()->index()->foreign()->references('id')->on('provinces');
                $table->string('name', 100);
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
        Schema::dropIfExists('cantons');
    }
}
