<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (!Schema::hasColumn('order_items', 'order_id')) {
                $table->foreignId('order_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('order_items', 'product_id')) {
                $table->foreignId('product_id')->after('order_id')->constrained()->onDelete('restrict');
            }
            if (!Schema::hasColumn('order_items', 'price')) {
                $table->unsignedBigInteger('price')->after('product_id');
            }
            if (!Schema::hasColumn('order_items', 'quantity')) {
                $table->unsignedInteger('quantity')->after('price');
            }
            if (!Schema::hasColumn('order_items', 'subtotal')) {
                $table->unsignedBigInteger('subtotal')->after('quantity');
            }
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            if (Schema::hasColumn('order_items', 'order_id')) {
                $table->dropConstrainedForeignId('order_id');
            }
            if (Schema::hasColumn('order_items', 'product_id')) {
                $table->dropConstrainedForeignId('product_id');
            }
            foreach (['price','quantity','subtotal'] as $col) {
                if (Schema::hasColumn('order_items', $col)) $table->dropColumn($col);
            }
        });
    }
};