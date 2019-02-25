<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSuspensionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'account_suspensions';

    /**
     * Run the migrations.
     * @table account_suspensions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id');
            $table->date('startDate');
            $table->integer('lengthInDays');
            $table->string('reason');
            $table->tinyInteger('isLifted')->default('0');
            $table->text('reasonLifted')->nullable();
            $table->timestamps();

            $table->index(["account_id"], 'fk_suspension_accounts1_idx');


            $table->foreign('account_id', 'fk_suspension_accounts1_idx')
                ->references('id')->on('accounts')
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
