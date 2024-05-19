<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    use HasFactory;

    protected $fillable = [ 'title_id', 
                            'first_name_id', 
                            'middle_name_id', 
                            'last_name_id', 
                            'company_id', 
                            'position_id', 
                            'short_description', 
                            'long_description', 
                            'comment'];

    public function title()
    {
        return $this->belongsTo(Title::class);
    }

    public function first_name()
    {
        return $this->belongsTo(First_name::class);
    }

    public function middle_name()
    {
        return $this->belongsTo(Middle_name::class);
    }

    public function last_name()
    {
        return $this->belongsTo(Last_name::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function presentations()
    {
        return $this->belongsToMany(Presentation::class, 'bridge_presentation_speaker');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'bridge_speaker_image');
    }

    public function social_sites()
    {
        return $this->hasMany(Bridge_speaker_social_site::class);
    }
    
}
