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
        Schema::create('departure_flights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('package_id')->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade'); 
            $table->date('departure_date')->nullable();
            $table->date('return_date')->nullable();
            $table->string('year')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->enum('category',['classic Hotels','superior Hotels']);
            $table->enum('status',['On Request','Show Price','Sold Out']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departure_flights');
    }
};
