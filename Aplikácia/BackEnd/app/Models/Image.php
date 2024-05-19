<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path_to', 'alt', 'comment'];

    public function social_sites()
    {
        return $this->hasMany(Social_site::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Conference::class, 'galleries');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }

    public function said_about_us()
    {
        return $this->hasMany(Said_about_us::class);
    }

    public function speakers()
    {
        return $this->hasMany(Speaker::class);
    }
}
