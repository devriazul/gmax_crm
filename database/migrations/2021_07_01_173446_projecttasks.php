<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projecttasks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projecttasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('prid')->nullable();
            $table->text('aid')->nullable();
            $table->text('task')->nullable();
            $table->text('assignedto')->nullable();
            $table->text('type')->nullable();
            $table->text('status')->nullable();                             
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
        Schema::dropIfExists('projecttasks');
    }
}
