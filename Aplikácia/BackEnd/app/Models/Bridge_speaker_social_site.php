<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bridge_speaker_social_site extends Model
{
    use HasFactory;

    protected $fillable = ['speaker_id', 'social_site_id', 'account'];

    public function speaker()
    {
        return $this->belongsTo(Speaker::class);
    }

    public function social_site()
    {
        return $this->belongsTo(Social_site::class);
    }
}
