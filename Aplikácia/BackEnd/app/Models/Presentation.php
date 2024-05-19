<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;

    protected $fillable = ['time_table_id', 'name', 'short_description', 'long_description', 'max_capacity', 'comment'];

    public function time_table()
    {
        return $this->belongsTo(Time_table::class);
    }

    public function speakers()
    {
        return $this->belongsToMany(Speaker::class, 'bridge_presentation_speaker');
    }

    public function participants()
    {
        return $this->belongsToMany(Participant::class, 'bridge_presentation_participant');
    }
}
