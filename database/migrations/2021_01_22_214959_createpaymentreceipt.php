<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createpaymentreceipt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentrecepits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('invoiceid')->nullable();
            $table->text('adminid')->nullable();
            $table->text('amount')->nullable();
            $table->text('date')->nullable();
            $table->text('transation')->nullable();
            $table->text('note')->nullable();     
            $table->text('method')->nullable();
            $table->text('gateway')->nullable();          
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
        Schema::dropIfExists('paymentrecepits');
    }
}
