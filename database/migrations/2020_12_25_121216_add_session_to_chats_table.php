<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSessionToChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('chats', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('session_id');
            $table->dateTime('read_at')->nullable();
            $table->boolean('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chats', function (Blueprint $table) {
            //
            $table->dropColumn('message_id');
            $table->dropColumn('session_id');
            $table->dropColumn('read_at');
            $table->dropColumn('type');
        });
    }
}
