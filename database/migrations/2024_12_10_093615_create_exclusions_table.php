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
        Schema::create('exclusions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade');   
            $table->string('name')->nullable();         
            $table->longText('description');
            $table->enum('status',['Active','InActive'])->default('Active');
            $table->string('type')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exclusions');
    }
};
