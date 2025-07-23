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
        Schema::create('education', function (Blueprint $table) {
            $table->id();

            $table->string('school_name');           // School or university name
            $table->string('major')->nullable();     // Major or field of study
            $table->string('degree')->nullable();    // Degree obtained (Bachelor, Master, etc.)
            $table->text('description')->nullable(); // Additional details or honors

            $table->date('start_date')->nullable();  // Start date of education
            $table->date('end_date')->nullable();    // End date (nullable if ongoing)
            $table->boolean('is_current')->default(false); // Currently enrolled?

            $table->unsignedTinyInteger('order')->default(0); // Display order

            $table->unsignedBigInteger('created_by')->nullable(); // Created by user ID (for CMS audit)
            $table->unsignedBigInteger('updated_by')->nullable(); // Last updated by user ID
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps();                   // created_at and updated_at
            $table->softDeletes();                  // For soft delete support
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education');
    }
};
