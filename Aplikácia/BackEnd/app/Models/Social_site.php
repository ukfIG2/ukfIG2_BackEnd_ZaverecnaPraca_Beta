<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social_site extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'image_id', 'comment'];

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function speakers()
    {
        return $this->hasMany(Bridge_speaker_social_site::class);
    }
}
