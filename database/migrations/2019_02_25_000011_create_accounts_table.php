<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'accounts';

    /**
     * Run the migrations.
     * @table accounts
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('accountRole', 10);
            $table->string('gender', 15);
            $table->string('email');
            $table->string('password');
            $table->string('firstName', 45);
            $table->string('middleName', 45)->nullable();
            $table->string('lastName', 45)->nullable();
            $table->date('dateOfBirth')->nullable();
            $table->binary('avatar')->nullable()->default(null);
            $table->tinyInteger('doForcePasswordChange')->default('0');
            $table->tinyInteger('isDeleted')->default('0');
            $table->tinyInteger('isVerified')->default('0');
            $table->longText('bio')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->index(["accountRole"], 'fk_accounts_accountRoles1_idx');

            $table->index(["gender"], 'fk_accounts_gender1_idx');

            $table->unique(["email"], 'email_UNIQUE');


            $table->foreign('gender', 'fk_accounts_gender1_idx')
                ->references('gender')->on('genders')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('accountRole', 'fk_accounts_accountRoles1_idx')
                ->references('role')->on('account_roles')
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
