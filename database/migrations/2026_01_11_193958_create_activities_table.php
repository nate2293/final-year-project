<?php

use App\Enums\ActivityType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This creates the Engagement Log table (applications).
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {

            // Primary Key for this table
            $table->Id();
            $table->foreignId('student_id')->constrained();
            $table->foreignId('opportunity_id')->constrained();

            $table->enum('activity_type', ActivityType::cases())->default(ActivityType::Application->value);

            // Key dates (use dates because they read nicely in reports)
            $table->date('activity_date')->nullable();

            // Status of the engagement/application
            // $table->string('status')->default('pending');

            // Optional text fields for evidence
            $table->text('notes')->nullable();
            $table->string('evidence_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Drops the entire table because up() created the entire table.
     */

    public function down(): void
    {
        //Schema::dropIfExists('activities');
        Schema::dropIfExists('applications');
    }
};
