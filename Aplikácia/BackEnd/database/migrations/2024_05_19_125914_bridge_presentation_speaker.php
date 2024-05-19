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
        Schema::create('bridge_presentation_speaker', function (Blueprint $table) {
            $table->foreignId('presentation_id')->constrained()->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
            $table->primary(['presentation_id', 'speaker_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridge_presentation_speaker');
    }
};
