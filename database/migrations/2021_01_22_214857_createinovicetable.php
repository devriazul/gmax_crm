<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createinovicetable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('type')->nullable();
            $table->text('title')->nullable();
            $table->text('userid')->nullable();
            $table->text('adminid')->nullable();           
            $table->text('invoid')->nullable();
            $table->text('quoteid')->nullable();
            $table->text('invodate')->nullable();
            $table->text('duedate')->nullable();
            $table->text('totalamount')->nullable();
            $table->text('paidamount')->nullable();
            $table->text('invostatus')->nullable();
            $table->text('quotestat')->nullable();
            $table->text('paod')->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
