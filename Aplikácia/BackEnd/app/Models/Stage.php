<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = ['conference_id', 'name', 'comment'];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function time_tables()
    {
        return $this->hasMany(Time_table::class);
    }
}
