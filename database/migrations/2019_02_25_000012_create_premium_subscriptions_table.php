<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiumSubscriptionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'premium_subscriptions';

    /**
     * Run the migrations.
     * @table premium_subscriptions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->unsignedInteger('plan_id');
            $table->dateTime('startDate');
            $table->timestamps();

            $table->index(["plan_id"], 'fk_PremiumSubscription_plan1_idx');

            $table->index(["account_id"], 'fk_PremiumSubscription_accounts1_idx');


            $table->foreign('account_id', 'fk_PremiumSubscription_accounts1_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('plan_id', 'fk_PremiumSubscription_plan1_idx')
                ->references('id')->on('subscription_plans')
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
