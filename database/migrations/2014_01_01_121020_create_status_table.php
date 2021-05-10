<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('color')->default('teal');
            $table->string('class')->default('teal');
            $table->text('description')->nullable();
            
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->boolean('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
           // $table->foreign('register_by')->references('id')->on('system_users'); 
           // $table->foreign('modified_by')->references('id')->on('system_users'); 
        });


        DB::table('status')->insert([
            [
                'name' => 'Active',
                'active' => 1,
            ],            
            [
                'name' => 'Disabled',
                'active' => 1
            ],            
            [
                'name' => 'New',
                'active' => 1
            ],            
            [
                'name' => 'Pending',
                'active' => 1
            ],            
            // [
            //     'name' => 'Discharged',
            //     'active' => 1
            // ],            
            // [
            //     'name' => 'Admitted',
            //     'active' => 1
            // ],            
            // [
            //     'name' => 'Awaiting',
            //     'active' => 1
            // ],           
            // [
            //     'name' => 'In Progress',
            //     'active' => 1
            // ],          
            // [
            //     'name' => 'Under Treatment',
            //     'active' => 1
            // ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status');
    }
}
