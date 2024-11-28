<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');           // ID của ảnh
            $table->bigInteger('product_id')->unsigned(); // Khóa ngoại liên kết sản phẩm
            $table->string('image_url');          // Đường dẫn ảnh
            $table->boolean('is_primary')->default(false); // Ảnh chính
            $table->timestamps();                 // created_at và updated_at

            // Khóa ngoại liên kết với bảng products
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('images');
    }
};
