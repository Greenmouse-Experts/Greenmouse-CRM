<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->references('id')->on('categories');
            $table->integer('supplier_id')->references('id')->on('suppliers');
            $table->string('product_name', 100)->nullable();
            $table->string('product_description', 100)->nullable();
            $table->string('product_code', 50)->unique();
            $table->integer('quantity')->default(0)->nullable();
            $table->unsignedDecimal('price', 10, 1)->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('product_image', 100)->nullable();
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
        Schema::dropIfExists('products');
    }
}
