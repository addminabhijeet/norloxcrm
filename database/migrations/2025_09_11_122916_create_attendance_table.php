<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // reference to junior
            $table->date('date');
            $table->enum('status', ['working', 'holiday', 'present', 'absent'])->default('working');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unique(['user_id', 'date']); // each user has one record per date
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
