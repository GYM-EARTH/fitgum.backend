<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chat_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('chat_id', 'chat_messages_foreign')->references('id')->on('chats')->onDelete('no action');
            $table->foreign('user_id', 'user_id_foreign')->references('id')->on('users')->onDelete('no action');
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
            $table->dropForeign('chat_messages_foreign');
            $table->dropForeign('user_id_foreign');
        });

        Schema::dropIfExists('chat_messages');
    }
}
