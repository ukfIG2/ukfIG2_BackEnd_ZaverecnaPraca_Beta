<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['position_name'];

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function said_about_us()
    {
        return $this->hasMany(Said_about_us::class);
    }
}
