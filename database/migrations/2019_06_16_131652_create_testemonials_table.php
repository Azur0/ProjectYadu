<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestemonialsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	private $tableName = 'testemonials';

	public function up()
	{
		Schema::create($this->tableName, function (Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('account_id')->nullable();
			$table->string('name', 99);
			$table->text('experience');
			$table->timestamps();

			$table->index(["account_id"], 'fk_testemonial_accounts_idx');

			$table->foreign('account_id', 'fk_testemonial_accounts_idx')
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
