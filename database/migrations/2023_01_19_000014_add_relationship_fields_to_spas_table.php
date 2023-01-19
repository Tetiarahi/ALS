<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSpasTable extends Migration
{
    public function up()
    {
        Schema::table('spas', function (Blueprint $table) {
            $table->unsignedBigInteger('emp_name_id')->nullable();
            $table->foreign('emp_name_id', 'emp_name_fk_7896982')->references('id')->on('employees');
        });
    }
}
