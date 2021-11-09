<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createclientstableaddon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->text('addedby')->nullable();
            $table->text('taxid')->nullable();
            $table->text('group')->nullable();
          
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->text('addedby')->nullable();
            $table->text('taxid')->nullable();
            $table->text('group')->nullable();
        });
    }
}
