<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatmessagesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'chatmessages';

    /**
     * Run the migrations.
     * @table chatmessages
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('event_id');
            $table->text('message');
            $table->tinyInteger('isDeleted')->default('0');
            $table->timestamps();

            $table->index(["event_id"], 'fk_accounts_has_activity_activity2_idx');

            $table->index(["account_id"], 'fk_accounts_has_activity_accounts2_idx');


            $table->foreign('account_id', 'fk_accounts_has_activity_accounts2_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('event_id', 'fk_accounts_has_activity_activity2_idx')
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
