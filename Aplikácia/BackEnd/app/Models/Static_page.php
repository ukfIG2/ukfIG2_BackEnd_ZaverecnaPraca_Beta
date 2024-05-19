<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Static_page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'comment'];
}
