<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pagespeed extends Model
{
    use HasFactory;
    protected $fillable = ['mobile_score', 'mobile_speed', 'desktop_score', 'desktop_speed', 'user_id', 'domain', 'link'];
    protected $dates = ['created_at'];

    public function link(): HasMany
    {
        return $this->belongsTo(Link::class, 'link' );
    }
}
