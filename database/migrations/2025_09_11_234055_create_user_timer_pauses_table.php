<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_timer_pauses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timer_log_id');
            $table->enum('pause_type', ['lunch','break','tea']);
            $table->dateTime('started_at');
            $table->dateTime('ended_at')->nullable();
            $table->integer('duration_seconds')->default(0);
            $table->timestamps();

            // Foreign key to user_timer_logs
            $table->foreign('timer_log_id')
                  ->references('id')
                  ->on('user_timer_logs')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_timer_pauses');
    }
};
