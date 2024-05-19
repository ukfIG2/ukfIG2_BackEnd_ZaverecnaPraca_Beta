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
        Schema::create('organizers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('title_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('first_name_id')->constrained()->onDelete('cascade');
            $table->foreignId('middle_name_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('last_name_id')->constrained()->onDelete('cascade');
            $table->enum('position', ['main', 'voluntary'])->default('voluntary');
            $table->boolean('publish')->default(false);
            $table->foreignId('email_id')->constrained()->onDelete('cascade')->nullable();
            $table->string('phone_number',20)->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizers');
    }
};
