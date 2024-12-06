<?php
// Run this command to create the migration: php artisan make:migration add_status_to_products_table
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Thêm cột status
            $table->enum('status', ['active', 'deleted'])->default('active');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // Xóa cột status nếu rollback migration
            $table->dropColumn('status');
        });
    }
}
