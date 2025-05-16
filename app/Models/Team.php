<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'external_id',
        'logo_url',
        'country',
    ];

    /**
     * Get the home matches for the team.
     */
    public function homeMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'home_team_id');
    }

    /**
     * Get the away matches for the team.
     */
    public function awayMatches(): HasMany
    {
        return $this->hasMany(Game::class, 'away_team_id');
    }

    /**
     * Get all matches for this team (both home and away).
     */
    public function allMatches()
    {
        return $this->homeMatches->merge($this->awayMatches)->sortByDesc('match_date');
    }

    /**
     * Get the last N matches for this team.
     */
    public function lastMatches($count = 5)
    {
        return $this->allMatches()->take($count);
    }
}
