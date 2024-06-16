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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('surname');
            $table->string('numCC')->nullable()->default(null);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('admin')->default('0');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('shipment_info', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('idUser');
            $table->string('city');
            $table->string('department');
            $table->string('district');
            $table->string('address');
            $table->string('info');
            $table->string('number')->nullable()->default(null);
            $table->string('phone');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('name');
            $table->string('category');
            $table->string('brand');
            $table->string('price');
            $table->string('cristal');
            $table->string('caja');
            $table->string('pulsera');
            $table->string('manecillas');
            $table->string('metrosAgua');
            $table->string('garanty');
            $table->string('amountAvailable');
            $table->timestamps();
        });

        Schema::create('infoProduct', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('idProduct');
            $table->string('info');
            $table->timestamps();
        });

        Schema::create('order', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('idProduct');
            $table->string('idUser');
            $table->string('idAddress');
            $table->string('state');
            $table->string('amount');
            $table->timestamps();
        });

        Schema::create('cart', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('idUser');
            $table->string('idProduct');
            $table->string('amount');
            $table->timestamps();
        });

        Schema::create('product_image', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('idProduct');
            $table->string('url');
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('shipment_info');
        Schema::dropIfExists('products');
        Schema::dropIfExists('infoProduct');
        Schema::dropIfExists('order');
        Schema::dropIfExists('cart');
        Schema::dropIfExists('product_image');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
