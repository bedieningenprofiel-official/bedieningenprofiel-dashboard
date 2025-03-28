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
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Vijfvoudige bedieningen test');
            $table->longText('description');
            $table->string('status')->default('inactive');
            $table->foreignId('team_id')->nullable();
            $table->unsignedBigInteger('parent_survey_id')->nullable();
            $table->boolean('is_template')->default(false);
            $table->timestamps();
        });

        Schema::table('surveys', function (Blueprint $table) {
            $table->foreign('team_id')
                ->references('id')
                ->on('teams')
                ->nullOnDelete();

            $table->foreign('parent_survey_id')
                ->references('id')
                ->on('surveys')
                ->nullOnDelete();
        });

        Schema::create('personality_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->text('left_statement');
            $table->text('right_statement');
            $table->foreignId('left_personality_id')->nullable()->constrained('personality_types');
            $table->foreignId('right_personality_id')->nullable()->constrained('personality_types');
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->json('personality_scores')->nullable();
            $table->timestamps();
        });

        Schema::create('survey_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('survey_response_id')->constrained()->onDelete('cascade');
            $table->foreignId('survey_question_id')->constrained()->onDelete('cascade');
            $table->enum('selected_option', ['left', 'right', 'neutral']);
            $table->tinyInteger('numeric_value');
            $table->timestamps();
        });
    }
};
