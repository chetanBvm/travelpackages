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
        Schema::create('stripe_payment_intents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stripe_payment_id')->nullable();
            $table->string('stripe_created')->nullable();
            $table->string('stripe_amount')->nullable();
            $table->string('amount_received')->nullable();
            $table->string('capture_method')->nullable();
            $table->string('client_secret')->nullable();
            $table->string('confirmation_method')->nullable();
            $table->string('currency')->nullable();
            $table->string('latest_charge')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_method_types')->nullable();
            $table->string('status')->nullable();
            $table->string('request_id')->nullable();
            $table->string('idempotency_key')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripe_payment_intents');
    }
};
