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
        Schema::table('packages', function (Blueprint $table) {
            $table->foreignId('packagetype_id')->references('id')->on('package_types')->onDelete('cascade')->onUpdate('cascade')->after('destination_id'); 
            $table->longText('accommodation')->nullable()->after('description');
            $table->longText('package_includes')->nullable()->after('accommodation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            //
        });
    }
};
