<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    /**
     * @inheritdoc
     */
    protected $fillable = [
        'firstName', 'lastName','playerImageURL','team_id'
    ];
}
