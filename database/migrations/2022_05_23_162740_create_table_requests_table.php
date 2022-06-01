<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members');
            $table->tinyInteger('request_type');
            $table->date('request_for_date');
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->string('compensation_time',10)->nullable();
            $table->date('compensation_date')->nullable();
            $table->tinyInteger('leave_all_day')->default(0);
            $table->string('leave_start',10)->nullable();
            $table->string('leave_end',10)->nullable();
            $table->string('leave_time',10)->nullable();
            $table->string('request_ot_time',10)->nullable();
            $table->string('reason',100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('manager_confirmed_status')->default(0);
            $table->dateTime('manager_confirmed_at')->nullable();
            $table->string('manager_confirmed_comment',100)->nullable();
            $table->tinyInteger('admin_approved_status')->default(0);
            $table->dateTime('admin_approved_at')->nullable();
            $table->string('admin_approved_comment',100)->nullable();
            $table->tinyInteger('error_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
