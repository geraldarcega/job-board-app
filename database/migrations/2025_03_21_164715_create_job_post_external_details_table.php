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
        Schema::create('job_post_external_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('job_post_id')->unsigned();
            $table->string('subcompany', 150)->nullable();
            $table->string('office', 150)->nullable();
            $table->string('department', 150)->nullable();
            $table->string('recruiting_category', 150)->nullable();
            $table->string('seniority', 50)->nullable();
            $table->string('schedule', 50)->nullable();
            $table->string('years_of_experience', 10)->nullable();
            $table->string('keywords')->nullable();
            $table->string('occupation', 150)->nullable();
            $table->string('occupation_category', 150)->nullable();
            $table->json('job_descriptions')->nullable();
            $table->json('additional_offices')->nullable();
            $table->timestamp('created_at');

            $table->foreign('job_post_id')
                ->references('id')
                ->on('job_posts');
        });

        Schema::table('job_posts', function (Blueprint $table) {
            $table->bigInteger('external_id')
                ->after('id')
                ->unsigned()
                ->nullable();
            $table->index('external_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_external_details');
    }
};
