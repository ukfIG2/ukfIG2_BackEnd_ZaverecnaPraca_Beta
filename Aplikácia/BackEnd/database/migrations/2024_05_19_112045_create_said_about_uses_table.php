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
        Schema::create('said_about_us', function (Blueprint $table) {
            $table->id();
            $table->foreignId('title_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('first_name_id')->constrained()->onDelete('cascade');
            $table->foreignId('middle_name_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('last_name_id')->constrained()->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('position_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('image_id')->nullable()->constrained()->onDelete('cascade');
            $table->text('text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('said_about_us');
    }
};
