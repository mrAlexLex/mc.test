<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesToDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees_to_departments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employees_id')->unsigned();
            $table->bigInteger('departments_id')->unsigned();
            $table->foreign('employees_id')->references('id')->on('employees')
                ->onDelete('cascade');
            $table->foreign('departments_id')->references('id')->on('departments')
                ->onDelete('cascade');
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
        Schema::dropIfExists('employees_to_departments');
    }
}
