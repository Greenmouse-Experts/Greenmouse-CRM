<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->string('first_name', 60)->nullable();
            $table->string('middle_name', 60)->nullable();
            $table->string('last_name', 60)->nullable();
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('dob')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->string('role')->nullable();
            $table->string('join_date')->nullable();
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
