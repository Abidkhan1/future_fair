<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyDetailInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('company_id')->unsigned()->nullable();
            $table->string('cnic')->nullable();
            $table->string('slogan')->nullable();
            $table->string('location')->nullable();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->string('web_url')->nullable();
            $table->date('creation_date')->nullable();
            $table->integer('total_employees')->nullable();
            $table->string('banner')->nullable();
            $table->string('poster')->nullable();
            $table->string('logo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
