<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'title', 'image', 'content'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
