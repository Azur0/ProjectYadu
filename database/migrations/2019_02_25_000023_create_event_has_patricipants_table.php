<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventHasPatricipantsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'event_has_patricipants';

    /**
     * Run the migrations.
     * @table event_has_patricipants
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('event_id');
            $table->integer('account_id');
            $table->enum('rating', ['1', '2', '3', '4', '5'])->nullable();

            $table->index(["account_id"], 'fk_accounts_has_activity_accounts1_idx');

            $table->index(["event_id"], 'fk_accounts_has_activity_activity1_idx');

            $table->unique(["event_id", "account_id"], 'event_id_account_id_UNIQUE');


            $table->foreign('account_id', 'fk_accounts_has_activity_accounts1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('event_id', 'fk_accounts_has_activity_activity1_idx')
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
