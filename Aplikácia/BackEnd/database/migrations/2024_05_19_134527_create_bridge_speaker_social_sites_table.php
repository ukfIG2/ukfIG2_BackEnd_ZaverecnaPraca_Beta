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
        Schema::create('bridge_speaker_social_sites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
            $table->foreignId('social_site_id')->constrained()->onDelete('cascade');
            $table->string('account')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bridge_speaker_social_sites');
    }
};
