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
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade'); // Junior ID
            $table->string('candidate_name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('resume_file'); // path to uploaded resume
            $table->enum('status', ['pending_review','forwarded_to_senior','accepted_by_senior','rejected_by_senior','customer_confirmation','paid','verified','in_training'])->default('pending_review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
