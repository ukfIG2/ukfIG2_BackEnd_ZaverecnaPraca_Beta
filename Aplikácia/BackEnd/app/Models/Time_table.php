<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time_table extends Model
{
    use HasFactory;

    protected $fillable = ['stage_id', 'time_start', 'time_end', 'comment'];

}
