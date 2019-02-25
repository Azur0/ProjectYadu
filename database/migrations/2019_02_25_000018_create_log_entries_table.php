<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogEntriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'log_entries';

    /**
     * Run the migrations.
     * @table log_entries
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id')->nullable();
            $table->string('category', 15);
            $table->text('entry');
            $table->string('ip', 45)->nullable();
            $table->timestamps();

            $table->index(["account_id"], 'fk_log_account1_idx');

            $table->index(["category"], 'fk_log_logCategory1_idx');


            $table->foreign('account_id', 'fk_log_account1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('category', 'fk_log_logCategory1_idx')
                ->references('category')->on('log_categories')
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
