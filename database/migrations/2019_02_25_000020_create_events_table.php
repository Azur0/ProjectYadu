<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'events';

    /**
     * Run the migrations.
     * @table events
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('status', 20);
            $table->unsignedInteger('location_id');
            $table->unsignedInteger('owner_id');
            $table->string('activityName', 45);
            $table->dateTime('startDate');
            $table->dateTime('endDate')->nullable();
            $table->text('description');
            $table->binary('bannerImage');
            $table->tinyInteger('isDeleted')->default('0');
            $table->timestamps();

            $table->index(["location_id"], 'fk_activity_Location1_idx');

            $table->index(["status"], 'fk_event_eventStatus1_idx');

            $table->index(["owner_id"], 'fk_activity_accounts1_idx');


            $table->foreign('location_id', 'fk_activity_Location1_idx')
                ->references('id')->on('locations')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('owner_id', 'fk_activity_accounts1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('status', 'fk_event_eventStatus1_idx')
                ->references('status')->on('event_status')
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
