<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','code','receiver_name','email','phone',
        'address','address_text','shipping_service',
        'subtotal','shipping_cost','total','status',
    ];

    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('receiver_name');
            $table->string('email');
            $table->string('phone', 30);
            $table->text('address');
            $table->string('shipping_service')->nullable();
            $table->unsignedBigInteger('subtotal')->default(0);
            $table->unsignedBigInteger('shipping_cost')->default(0);
            $table->unsignedBigInteger('total')->default(0);
            $table->enum('status', ['diproses','dikirim','selesai','batal'])->default('diproses');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(OrderItem::class); }
}
