<?php

namespace FossHaas\Courses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeblinkActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'url',
    ];
}
