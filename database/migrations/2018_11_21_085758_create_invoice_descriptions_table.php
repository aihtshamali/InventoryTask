<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->double('rate',8,2)->nullable();
            $table->double('amount',8,2)->nullable();
            $table->integer('invoice_id')->unsigned()->index()->nullable();
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
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
        Schema::dropIfExists('invoice_descriptions');
    }
}
