<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prediction extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'raw_prediction_data',
        'home_win_probability',
        'draw_probability',
        'away_win_probability',
        'over_2_5_goals_probability',
        'both_teams_score_probability',
        'predicted_winner',
    ];

    protected $casts = [
        'raw_prediction_data' => 'array',
        'home_win_probability' => 'float',
        'draw_probability' => 'float',
        'away_win_probability' => 'float',
        'over_2_5_goals_probability' => 'float',
        'both_teams_score_probability' => 'float',
    ];

    /**
     * Get the home team for this prediction.
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team for this prediction.
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
