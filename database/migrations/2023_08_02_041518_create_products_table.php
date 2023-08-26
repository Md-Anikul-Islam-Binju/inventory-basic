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
            $table->string('product_code');
            $table->integer('category_id')->nullable();
            $table->string('type')->nullable();
            $table->string('size');
            $table->string('model_no');
            $table->integer('manufacturer_id')->nullable();
            $table->integer('purchase_quantity')->nullable();
            $table->integer('purchase_supplier_id')->nullable();
            $table->string('unit_price')->nullable();
            $table->integer('purchase_quantity_to_after_sell')->nullable();
            $table->string('product_image')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('products');
    }
}
