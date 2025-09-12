<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_timer_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('login_id');
            $table->dateTime('start_time');
            $table->integer('remaining_seconds')->default(28800); // 8 hours
            $table->enum('status', ['running', 'paused', 'stopped'])->default('running');
            $table->enum('pause_type', ['lunch','break','tea'])->nullable()->default(null);
            $table->timestamps(); // creates created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_timer_logs');
    }
};
