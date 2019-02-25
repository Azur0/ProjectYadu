<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasTagsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'event_has_tags';

    /**
     * Run the migrations.
     * @table event_has_tags
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('event_id');
            $table->string('tag', 25);

            $table->index(["event_id"], 'fk_eventTags_has_event_event1_idx');

            $table->index(["tag"], 'fk_eventTags_has_event_eventTags1_idx');

            $table->unique(["event_id", "tag"], 'event_id_tag_UNIQUE');


            $table->foreign('tag', 'fk_eventTags_has_event_eventTags1_idx')
                ->references('tag')->on('event_tags')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('event_id', 'fk_eventTags_has_event_event1_idx')
                ->references('id')->on('events')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
