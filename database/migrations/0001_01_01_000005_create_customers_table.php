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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('id');
            $table->string('first_name', 20);
            $table->string('last_name', 20);
            $table->string('register', 14)->nullable()->unique();
            $table->string('document', 12)->unique();
            $table->string('whatsapp', 12)->nullable()->unique();
            $table->string('phone', 12)->nullable()->unique();
            $table->string('email', 50)->unique();
            $table->string('where_find', 30)->nullable();
            $table->timestamps();
        });
    }

    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->integer('main', 1);
            $table->string('type', 10);
            $table->string('responsible', 20);
            $table->string('phone', 13);
            $table->string('zip', 9);
            $table->string('address', 45);
            $table->string('number', 8);
            $table->string('complement', 30)->nullable();
            $table->string('district', 35);
            $table->string('city', 30);
            $table->string('state', 2);
            $table->string('information', 128);
            $table->string();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};