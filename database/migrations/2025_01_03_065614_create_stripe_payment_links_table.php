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
        Schema::create('stripe_payment_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('booking_id')->references('id')->on('bookings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('stripe_id')->nullable();
            $table->string('stripe_object')->nullable();
            $table->string('stripe_active')->nullable();
            $table->string('stripe_allow_promotion')->nullable();
            $table->string('stripe_redirect_url')->nullable();
            $table->string('stripe_currency')->nullable();
            $table->string('stripe_url')->nullable();
            $table->string('stripe_submit_type')->nullable();
            $table->string('payment_method_types')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_payment_links');
    }
};
