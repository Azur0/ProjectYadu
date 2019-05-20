<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_settings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('account_id');
            $table->tinyInteger('FollowNotificationCreateEvent')->default('1');
            $table->tinyInteger('FollowNotificationJoinEvent')->default('1');
            $table->tinyInteger('NotificationInvite')->default('1');
            $table->tinyInteger('NotificationEventEdited')->default('1');
            $table->tinyInteger('NotificationEventDeleted')->default('1');
            $table->timestamps();

            $table->foreign('account_id', 'fk_settings_accounts1_idx')
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
        Schema::dropIfExists('account_settings');
    }
}
