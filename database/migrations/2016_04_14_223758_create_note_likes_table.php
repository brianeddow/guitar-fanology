<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_guitar_notes_request_likes', function (Blueprint $table) {
            $table->increments('like_id');
            $table->integer('edit_guitar_notes_request_id')->unsigned()->index();
            $table->integer('count')->default(0)->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('edit_guitar_notes_request_likes');
    }
}
