<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email'];

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function organizers()
    {
        return $this->hasMany(Organizer::class);
    }
}
