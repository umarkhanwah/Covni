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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hosp_id');
            $table->unsignedBigInteger('user_id');
            $table->string('time');
            $table->date('date');
            $table->unsignedBigInteger('report_id')->nullable()->default(NULL);
            $table->timestamps();
            
            // Define foreign key constraints
            $table->foreign('hosp_id')->references('id')->on('hospitals');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('report_id')
            ->references('id')
            ->on('test_reports')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
