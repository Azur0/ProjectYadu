<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'organisations';

    /**
     * Run the migrations.
     * @table organisations
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 45);
            $table->text('description')->nullable();
            $table->tinyInteger('isDeleted')->default('0');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->integer('phonenumber')->nullable();
            $table->string('postalcode', 45)->nullable();
            $table->integer('housenumber')->nullable();
            $table->string('housenumberAddition', 2)->nullable();
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
       Schema::dropIfExists($this->tableName);
     }
}
