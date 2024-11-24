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
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('password');
        $table->string('phone', 20)->nullable();
        $table->text('address')->nullable();
        $table->enum('role', ['customer', 'admin', 'staff'])->default('customer');
        $table->timestamps(0);
    });
}

public function down()
{
    Schema::dropIfExists('users');
}

};
