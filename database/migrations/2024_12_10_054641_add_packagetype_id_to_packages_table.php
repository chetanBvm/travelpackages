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
            $table->string('min_age')->nullable()->after('package_includes');
            $table->string('max_age')->nullable()->after('min_age');
            $table->longText('inclusion')->nullable()->after('max_age');
            $table->longText('exclusion')->nullable()->after('max_age');
            $table->string('map_image')->nullable()->after('thumbnail');
            $table->longText('itinerary')->nullable()->after('map_image');
            $table->longtext('departure_month')->nullable()->after('itinerary');
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
