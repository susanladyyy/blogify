<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'user_id',
        'content',
        'external_id',
        'source'
    ];

    protected $casts = [
        'status' => PostStatus::class
    ];

    public function user() {
        return $this->belogsTo(User::class);
    }
}
