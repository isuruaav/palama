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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('district_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->string('slug')->unique();
            $table->decimal('price_from', 10, 2)->nullable();
            $table->string('phone');
            $table->string('whatsapp')->nullable();
            $table->string('location_text')->nullable();
            $table->boolean('is_emergency')->default(false);
            $table->string('available_hours')->nullable();
            $table->enum('status', ['active', 'pending', 'rejected'])->default('pending');
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->decimal('avg_rating', 3, 1)->default(0);
            $table->integer('reviews_count')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
