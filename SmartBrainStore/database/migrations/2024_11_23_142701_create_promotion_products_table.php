<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('promotion_products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade');
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
        $table->timestamps(0);
    });
}

public function down()
{
    Schema::dropIfExists('promotion_products');
}

};
