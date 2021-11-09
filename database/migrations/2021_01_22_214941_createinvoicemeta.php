<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createinvoicemeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoicemetas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('invoiceid')->nullable();
            $table->text('authid')->nullable();
            $table->text('qty')->nullable();
            $table->text('qtykey')->nullable();
            $table->text('meta')->nullable();
            $table->text('tax')->nullable();
            $table->text('amount')->nullable();
            $table->text('total')->nullable();         
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
        Schema::dropIfExists('invoicemetas');
    }
}
