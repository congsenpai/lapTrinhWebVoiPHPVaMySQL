<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->softDeletes();  // Thêm trường `deleted_at` cho bảng `brands`
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropSoftDeletes();  // Xóa trường `deleted_at` nếu rollback migration
        });
    }
}
