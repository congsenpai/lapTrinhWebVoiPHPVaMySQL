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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('discount_type', ['percentage', 'fixed']);
            $table->decimal('discount_value', 10, 2);
            $table->integer('usage_limit')->default(0);
            $table->integer('used_count')->default(0);
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('coupons');
    }
};
