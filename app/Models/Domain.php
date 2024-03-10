<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = ['domain', 'user_id'];

    public function link(): HasMany
    {
        return $this->hasMany(Link::class, 'domain');
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

