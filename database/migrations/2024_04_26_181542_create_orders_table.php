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
            $table->integer('user_id');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->string('country_name');
            $table->string('city_name');
            $table->string('customer_postcode');
            $table->string('customer_address');
            $table->integer('discount');
            $table->float('subtotal');
            $table->float('total');
            $table->integer('payment_option')->comment('1=credit card, 2=cod');
            $table->integer('payment_status')->comment('1=pending, 2=done');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
