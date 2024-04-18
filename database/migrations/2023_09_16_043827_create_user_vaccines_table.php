<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_vaccines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vaccine_id'); // Change to unsignedBigInteger
            $table->unsignedInteger('quantity');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hosp_id');
            $table->timestamps();
    
            // Define the foreign key constraint
            $table->foreign('vaccine_id')->references('id')->on('vaccines')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hosp_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }
    
    // public function up()
    // {
    //     Schema::create('user_vaccines', function (Blueprint $table) {
    //         $table->id();
    //         $table->string('vaccine_id');
    //         $table->unsignedInteger('quantity');
    //         $table->unsignedBigInteger('user_id');
    //         $table->timestamps();
    //     });
    // }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vaccines');
    }
};
