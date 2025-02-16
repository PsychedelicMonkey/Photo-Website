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
        Schema::create('portfolio_albums', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->foreignUlid('portfolio_model_id')->nullable()->constrained('portfolio_models')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->string('location')->nullable();
            $table->date('shooting_date')->nullable();
            $table->boolean('is_visible')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_albums');
    }
};
