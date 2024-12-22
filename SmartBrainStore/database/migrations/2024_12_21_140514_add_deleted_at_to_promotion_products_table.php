<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPromotionProductsTable extends Migration
{
    public function up()
    {
        Schema::table('promotion_products', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('promotion_products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
