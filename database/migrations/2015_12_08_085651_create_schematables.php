<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchematables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE TABLE schematables (
                database_name varchar(50) NULL,
                schema_name varchar(50) NULL,
                size_in_gb float NULL,
                hold_status tinyint(1) NULL,
                hold_by varchar(50) NULL,
                hold_till_date date NULL
            )
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('schematables');
    }
}
