<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagespeed extends Model
{
    use HasFactory;
    protected $fillable = ['mobile_score', 'mobile_speed', 'desktop_score', 'desktop_speed', 'user_id', 'domain'];
    protected $dates = ['created_at'];
}
