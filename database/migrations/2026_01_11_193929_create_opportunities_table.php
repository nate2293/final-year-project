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
        Schema::create('opportunities', function (Blueprint $table) {
            // PK
            $table->id();       

            // FK references company table
            $table->foreignId('company_id')->constrained();   

            // Fields
            $table->string('job_title');
            $table->text('job_description')->nullable();
            $table->string('job_category')->nullable();
            $table->text('requirements')->nullable();
            $table->date('application_deadline')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
