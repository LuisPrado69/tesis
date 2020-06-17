<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('notification_user')) {
            Schema::create('notification_user', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('receiver_id')->unsigned()->index()->foreign()->references('id')->on('users');
                $table->integer('notification_id')->unsigned()->index()->foreign()->references('id')->on('notifications');
                $table->integer('read')->default(0);
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
        Schema::dropIfExists('notification_user');
    }
}
