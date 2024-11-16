<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('user_id')->index();
            $table->foreignId('customer_id')->index();
            $table->string('customer_name', 45);
            $table->string('whatsapp', 12);
            $table->string('phone', 12);
            $table->string('email', 50);
            $table->string('document', 12);
            $table->string('zip', 8);
            $table->string('address', 50);
            $table->string('number', 8);
            $table->string('complement', 30)->nullable();
            $table->string('district', 35);
            $table->decimal('discount', 12, 2);
            $table->decimal('addition', 12, 2);
            $table->decimal('total_order', 12, 2);
            $table->text('payment');

            $table->text('observation')->nullable();
            $table->timestamps();
        });

        Schema::create('orders_products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('product_id')->index();
            $table->integer('order_id')->index();
            $table->char('code', 18);
            $table->string('name', 50);
            $table->decimal('sale_price', 12, 2);
            $table->decimal('cost_price', 12, 2);
            $table->char('quantity', 2);
//            $table->string('variation', 40)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orders_products');
    }
};