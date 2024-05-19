<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = ['conference_id', 'name', 'url', 'image_id', 'comment'];

    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
