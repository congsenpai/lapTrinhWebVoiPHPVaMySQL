<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('payment_method', ['credit_card', 'paypal', 'bank_transfer', 'cash_on_delivery']);
            $table->enum('payment_status', ['pending', 'completed', 'failed'])->default('pending');
            $table->timestamp('payment_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->decimal('amount', 10, 2);
            $table->timestamps(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
