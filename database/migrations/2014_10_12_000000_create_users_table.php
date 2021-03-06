<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('entity');
            $table->tinyInteger('juridical')->default(0);
            $table->string('name');
            $table->string('full_name', 400)->nullable();
            $table->string('iin');
            $table->string('work_phone', 255)->nullable();
            $table->string('email')->nullable();
            $table->string('fact_address', 255)->nullable();
            $table->string('jur_address', 255)->nullable();
            $table->string('nds_number', 255)->nullable();
            $table->string('bank_account', 255)->nullable();
            $table->string('contract', 255)->nullable();
            $table->string('code', 20);
            $table->string('manager', 255)->nullable();
            $table->string('password');
            $table->tinyInteger('is_deleted')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
