<?php



use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVaccinesTable extends Migration
{
    public function up()
    {
        Schema::create('vaccines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('user_id')->nullable()->default(NULL);
            $table->unsignedBigInteger('hosp_id')->nullable()->default(NULL);
            $table->unsignedInteger('quantity')->default(0); // Add a quantity column with a default value of 0
            $table->timestamps();
    
            // Define foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('hosp_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('vaccines');
    }
}
