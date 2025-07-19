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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->string('url')->nullable(); // URL to the project
            $table->string('github_url')->nullable(); // URL to the GitHub repository
            $table->string('status')->default('draft'); // e.g., draft, published
            $table->date('start_date')->nullable(); // Start date of the project
            $table->date('end_date')->nullable(); // End date of the project
            $table->boolean('is_featured')->default(false); // Whether the project is featured
            $table->integer('order')->default(0); // Order for sorting projects
            $table->text('technologies')->nullable(); // Technologies used in the project, stored as JSON
            $table->date('completed_at')->nullable();

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
