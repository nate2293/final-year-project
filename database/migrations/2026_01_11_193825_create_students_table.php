<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Migrations are a tool for managing database schemas. Version control allows for 
     * easier interaction with your database. Also very useful working with other developers.
     * Can roll back changes if something goes wrong.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            // Creates a primary key column.
            $table->id();

            // Create Foreign Key
            $table->foreignId('user_id')->constrained();

            // Fields 
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('address')->nullable();
            $table->string('university');
            $table->string('linkedin_profile')->nullable();

            // Creates: created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
