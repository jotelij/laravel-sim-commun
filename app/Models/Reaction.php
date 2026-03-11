<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reaction extends Model
{
    /** @use HasFactory<\Database\Factories\ReactionFactory> */
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'reactionable_id',
        'reactionable_type',
    ];

     /**
     * Get the parent reactionable model (post or comment).
     */
    public function reactionable(): MorphTo
    {
        return $this->morphTo();
    }
}
