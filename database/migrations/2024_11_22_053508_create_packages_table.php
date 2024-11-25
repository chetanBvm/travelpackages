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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->references('id')->on('destinations')->onDelete('cascade')->onUpdate('cascade');            
            $table->string('name');
            $table->longText('description');
            $table->decimal('price',8,2);  
            $table->string('images')->nullable();
            $table->string('days');
            $table->enum('status',['Active','InActive'])->default('Active');          
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
