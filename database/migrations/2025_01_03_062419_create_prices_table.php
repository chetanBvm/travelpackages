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
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stripe_id')->nullable();
            $table->string('stripe_object')->nullable();
            $table->string('stripe_created')->nullable();
            $table->string('stripe_currency')->nullable();
            $table->string('stripe_product')->nullable();
            $table->string('stripe_unit_amount')->nullable();
            $table->string('stripe_unit_amount_decimal')->nullable();
            $table->string('stripe_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
