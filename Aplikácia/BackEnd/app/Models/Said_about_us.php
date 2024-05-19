<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Said_about_us extends Model
{
    use HasFactory;

    protected $table = 'said_about_us';

    protected $fillable = ['title_id', 'first_name_id', 'middle_name_id', 'last_name_id', 'company_id', 'position_id', 'text', 'image_id'];

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

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}
