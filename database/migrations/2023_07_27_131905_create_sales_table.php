<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->nullable();
            $table->foreignId('product_id')->onDelete('cascade');
            $table->foreignId('invoice_id')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->nullable();
            $table->integer('quantity');
            $table->decimal('price',15,2)->nullable();
            $table->decimal('amount',15,2)->nullable();
            $table->string('date_of_payment');
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
