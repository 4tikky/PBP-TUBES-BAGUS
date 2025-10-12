<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('carts', 'product_id')) {
                $table->foreignId('product_id')->after('user_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('carts', 'quantity')) {
                $table->unsignedInteger('quantity')->default(1)->after('product_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            if (Schema::hasColumn('carts', 'quantity')) {
                $table->dropColumn('quantity');
            }
            if (Schema::hasColumn('carts', 'product_id')) {
                $table->dropConstrainedForeignId('product_id');
            }
        });
    }
};
