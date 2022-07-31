<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'name', 'logoURL'
    ];

    /**
     * @return HasMany
     */
    public function players(): HasMany
    {
        return $this->hasMany(Player::class,'team_id');
    }
}
