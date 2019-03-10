<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_pictures', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('tag', 25);
            $table->timestamps();

            $table->index(["tag"], 'fk_event_pictures_eventTags1_idx');

            $table->foreign('tag', 'fk_event_pictures_eventTags1_idx')
            ->references('tag')->on('event_tags');


        });
        DB::statement("ALTER TABLE event_pictures ADD picture LONGBLOB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_pictures');
    }
}
