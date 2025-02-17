<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingPlayerStream extends Model
{
    use HasFactory;

    protected $fillable = ['active_player'];
}
