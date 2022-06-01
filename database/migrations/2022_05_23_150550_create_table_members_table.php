<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('member_code', 10)->unique();
            $table->string('full_name', 100);
            $table->string('email', 80)->unique();
            $table->string('nick_name', 80)->nullable();
            $table->string('password', 80);
            $table->string('other_email', 80)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('skype', 30)->nullable();
            $table->string('facebook', 100)->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('marital_status')->default(1);
            $table->string('avatar', 255)->nullable();
            $table->string('avatar_official', 255)->nullable();
            $table->date('birth_date');
            $table->string('permanent_address', 255);
            $table->string('temporary_address', 255);
            $table->string('identity_number', 12);
            $table->date('identity_card_date');
            $table->string('identity_card_place', 50);
            $table->string('passport_number', 20)->nullable();
            $table->date('passport_expiration')->nullable();
            $table->string('nationality', 50);
            $table->string('emergency_contact_name', 70);
            $table->string('emergency_contact_relationship', 50);
            $table->string('emergency_contact_number', 20);
            $table->string('academic_level', 50)->nullable();
            $table->string('graduate_year', 4)->nullable();
            $table->string('bank_name', 30);
            $table->string('bank_account', 20);
            $table->string('tax_identification', 20)->nullable();
            $table->date('tax_date')->nullable();
            $table->string('tax_place', 50)->nullable();
            $table->string('insurance_number', 20)->nullable();
            $table->string('healthcare_provider', 30)->nullable();
            $table->date('start_date_official')->nullable();
            $table->date('start_date_probation')->nullable();
            $table->date('end_date')->nullable();
            $table->tinyInteger('status');
            $table->text('note')->nullable();
            $table->bigInteger('created_by');
            $table->rememberToken();
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
        Schema::dropIfExists('members');
    }
}
