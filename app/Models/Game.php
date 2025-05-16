<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'home_goals',
        'away_goals',
        'match_date',
        'competition',
        'external_id',
        'result',
        'is_finished',
    ];

    protected $casts = [
        'match_date' => 'date',
        'is_finished' => 'boolean',
    ];

    /**
     * Get the home team for this match.
     */
    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    /**
     * Get the away team for this match.
     */
    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    /**
     * Determine the result of the match.
     */
    public function getResult(): string
    {
        if ($this->home_goals > $this->away_goals) {
            return 'home_win';
        } elseif ($this->away_goals > $this->home_goals) {
            return 'away_win';
        } else {
            return 'draw';
        }
    }

    /**
     * Calculate if both teams scored in this match.
     */
    public function bothTeamsScored(): bool
    {
        return $this->home_goals > 0 && $this->away_goals > 0;
    }

    /**
     * Calculate if there were more than 2.5 goals in this match.
     */
    public function overTwoPointFiveGoals(): bool
    {
        return ($this->home_goals + $this->away_goals) > 2.5;
    }

    /**
     * Total goals scored in the match.
     */
    public function totalGoals(): int
    {
        return $this->home_goals + $this->away_goals;
    }
}
