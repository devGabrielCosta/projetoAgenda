<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\UserType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {   
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->enum("type", array_column(UserType::cases(), 'name'));
        });

        
        Schema::create('doctors_ubs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('ubs_id');

            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ubs_id')->references('id')->on('ubs')->onDelete('cascade');

            $table->unique(['doctor_id', 'ubs_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors_ubs');
        Schema::dropIfExists('users');
    }
};
