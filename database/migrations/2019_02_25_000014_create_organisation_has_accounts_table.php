<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationHasAccountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'organisation_has_accounts';

    /**
     * Run the migrations.
     * @table organisation_has_accounts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('organisation_id');

            $table->index(["account_id"], 'fk_account_has_organisation_accounts1_idx');

            $table->index(["organisation_id"], 'fk_account_has_organisation_organisation1_idx');

            $table->unique(["account_id", "organisation_id"], 'account_id_organisation_id_UNIQUE');


            $table->foreign('account_id', 'fk_account_has_organisation_accounts1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('organisation_id', 'fk_account_has_organisation_organisation1_idx')
                ->references('id')->on('organisations')
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
