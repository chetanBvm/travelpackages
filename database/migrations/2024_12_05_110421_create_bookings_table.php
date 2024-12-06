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
        Schema::create('bookings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_id')->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade'); 
            $table->string('c_formName');
            $table->string('c_currency');
            $table->string('departure_date');
            $table->foreignId('departure_city')->references('id')->on('airports')->onDelete('cascade')->onUpdate('cascade');
            $table->string('passengers_adult');
            $table->string('passengers_children')->nullable();
            $table->string('passengers_infant')->nullable();
            $table->string('room_occupancy')->nullable();
            $table->string('passenger_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('c_email');
            $table->string('signup');
            $table->string('package_name');
            $table->string('transaction_id');
            $table->string('special_requests')->nullable();
            $table->enum('status',['Booking','Approved','Cancel','Pending','rejected'])->default('Pending');
            $table->longText('reject_reason')->nullable();
            $table->string('payment_gateway_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
