<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Enable PostGIS extension
        DB::statement('CREATE EXTENSION IF NOT EXISTS postgis');

        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('logo_url')->nullable();
            $table->string('cover_image_url')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        // Add PostGIS geography column and spatial index
        DB::statement('ALTER TABLE restaurants ADD COLUMN location geography(Point, 4326)');
        DB::statement('CREATE INDEX restaurants_location_idx ON restaurants USING GIST (location)');
    }

    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
