<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('projectname')->nullable();
            $table->text('client')->nullable();
            $table->text('description')->nullable();
            $table->text('startdate')->nullable();
            $table->text('deadline')->nullable();
            $table->text('status')->nullable();
            $table->text('amount')->nullable();                           
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
        Schema::dropIfExists('projects');
    }
}
