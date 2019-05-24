<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportedUsersTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'reported_users';

    /**
     * Run the migrations.
     * @table reported_users
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('reportedUser_id');
            $table->unsignedInteger('reportSubmitter_id');
            $table->string('reportReason', 30);
            $table->unsignedInteger('chatmessage_id')->nullable();
            $table->unsignedInteger('event_id')->nullable();
            $table->text('explanation')->nullable();
            $table->timestamps();

            $table->index(["reportSubmitter_id"], 'fk_reports_accounts2_idx');

            $table->index(["event_id"], 'fk_userReports_activity1_idx');

            $table->index(["reportReason"], 'fk_userReports_reportReasonType1_idx');

            $table->index(["reportedUser_id"], 'fk_reported_users_accounts1_idx');

            $table->index(["chatmessage_id"], 'fk_reports_chatMessage1_idx');


            $table->foreign('reportSubmitter_id', 'fk_reports_accounts2_idx')
                ->references('id')->on('accounts')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('chatmessage_id', 'fk_reports_chatMessage1_idx')
                ->references('id')->on('chat_messages')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('event_id', 'fk_userReports_activity1_idx')
                ->references('id')->on('events')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('reportReason', 'fk_userReports_reportReasonType1_idx')
                ->references('reason')->on('report_reasons')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('reportedUser_id', 'fk_reported_users_accounts1_idx')
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
