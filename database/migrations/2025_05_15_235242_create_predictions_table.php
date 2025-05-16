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
        Schema::create('predictions', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('home_team_id')->constrained('teams');
            $table->foreignUuid('away_team_id')->constrained('teams');
            $table->json('raw_prediction_data');
            $table->float('home_win_probability')->nullable();
            $table->float('draw_probability')->nullable();
            $table->float('away_win_probability')->nullable();
            $table->float('over_2_5_goals_probability')->nullable();
            $table->float('both_teams_score_probability')->nullable();
            $table->string('predicted_winner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('predictions');
    }
};
