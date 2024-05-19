<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'state', 'comment', 'address_of_conference'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }

    public function galleries()
    {
        return $this->belongsToMany(Image::class, 'galleries');
    }

    public function sponsors()
    {
        return $this->hasMany(Sponsor::class);
    }
}
