<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestToEditGuitarNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edit_guitar_notes_request', function (Blueprint $table) {
            $table->increments('note_id');
            $table->integer('guitar_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('edit_guitar_notes_request');
    }
}
