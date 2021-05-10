<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
        });
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'Super Admin',
                'description' => 'Technician',
                'created_by' => 1,
                'created_at' => '2021-01-01 06:05:04',
            ],
            [
                'id' => 2,
                'name' => 'Customer',
                'description' => 'Customer',
                'created_by' => 1,
                'created_at' => '2021-01-01 06:05:04',
            ],

        ]);
    }
}
