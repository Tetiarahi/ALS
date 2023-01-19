<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEmployeesTable extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_qua_id')->nullable();
            $table->foreign('emp_qua_id', 'emp_qua_fk_7896974')->references('id')->on('qualifications');
            $table->unsignedBigInteger('workstatus_id')->nullable();
            $table->foreign('workstatus_id', 'workstatus_fk_7901631')->references('id')->on('emp_work_statuses');
        });
    }
}
