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
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title', 150);
            $table->longText('description');
            $table->string('posted_by',150);
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_spam')->default(false);
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            $table->index('slug');
            $table->index('title');
            $table->index('posted_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_posts');
    }
};
