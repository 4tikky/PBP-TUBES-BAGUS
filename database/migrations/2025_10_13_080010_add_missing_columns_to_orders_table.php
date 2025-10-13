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
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'code')) {
                $table->string('code')->nullable()->unique()->after('user_id');
            }
            if (!Schema::hasColumn('orders', 'receiver_name')) {
                $table->string('receiver_name')->nullable()->after('code');
            }
            if (!Schema::hasColumn('orders', 'email')) {
                $table->string('email')->nullable()->after('receiver_name');
            }
            if (!Schema::hasColumn('orders', 'phone')) {
                $table->string('phone', 30)->nullable()->after('email');
            }
            if (!Schema::hasColumn('orders', 'address')) {
                $table->text('address')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('orders', 'shipping_service')) {
                $table->string('shipping_service')->nullable()->after('address');
            }
            if (!Schema::hasColumn('orders', 'subtotal')) {
                $table->unsignedBigInteger('subtotal')->default(0)->after('shipping_service');
            }
            if (!Schema::hasColumn('orders', 'shipping_cost')) {
                $table->unsignedBigInteger('shipping_cost')->default(0)->after('subtotal');
            }
            if (!Schema::hasColumn('orders', 'total')) {
                $table->unsignedBigInteger('total')->default(0)->after('shipping_cost');
            }
            if (!Schema::hasColumn('orders', 'status')) {
                $table->enum('status', ['diproses','dikirim','selesai','batal'])->default('diproses')->after('total');
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
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'status')) $table->dropColumn('status');
            if (Schema::hasColumn('orders', 'total')) $table->dropColumn('total');
            if (Schema::hasColumn('orders', 'shipping_cost')) $table->dropColumn('shipping_cost');
            if (Schema::hasColumn('orders', 'subtotal')) $table->dropColumn('subtotal');
            if (Schema::hasColumn('orders', 'shipping_service')) $table->dropColumn('shipping_service');
            if (Schema::hasColumn('orders', 'address')) $table->dropColumn('address');
            if (Schema::hasColumn('orders', 'phone')) $table->dropColumn('phone');
            if (Schema::hasColumn('orders', 'email')) $table->dropColumn('email');
            if (Schema::hasColumn('orders', 'receiver_name')) $table->dropColumn('receiver_name');
            if (Schema::hasColumn('orders', 'code')) $table->dropUnique('orders_code_unique');
            if (Schema::hasColumn('orders', 'code')) $table->dropColumn('code');
        });
    }
};
