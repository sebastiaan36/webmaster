<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    use HasFactory;
    protected $fillable = ['url', 'domain', 'user_id'];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }
}
