<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PostStatus;

class Post extends Model
{
    protected $fillable = [

    ];

    protected $casts = [
        'status' => PostStatus::class
    ];
}
