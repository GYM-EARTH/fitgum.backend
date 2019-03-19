<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('chat_id', 'chat_id_foreign')->references('id')->on('chats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_users', function (Blueprint $table) {
            $table->dropForeign('chat_id_foreign');
        });

        Schema::dropIfExists('chat_users');
    }
}
