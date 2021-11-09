<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Projectnotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projectnotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('pjid')->nullable();
            $table->text('admin')->nullable();
            $table->text('note')->nullable();                                     
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
        Schema::dropIfExists('projectnotes');
    }
}
