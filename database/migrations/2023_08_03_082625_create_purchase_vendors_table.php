<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_vendors', function (Blueprint $table) {
            $table->id();
            $table->string('vendor_name');
            $table->string('vendor_email')->nullable();
            $table->string('vendor_phone');
            $table->string('vendor_address')->nullable();
            $table->integer('status')->default(1)->comment('1:active, 0:inactive');
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
        Schema::dropIfExists('purchase_vendors');
    }
}
