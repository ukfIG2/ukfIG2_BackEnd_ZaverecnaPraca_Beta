<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['title_id', 'first_name_id', 'middle_name_id', 'last_name_id', 'company_id', 'position_id', 'email_id', 'token_link', 'comment'];

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

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function presentations()
    {
        return $this->belongsToMany(Presentation::class, 'bridge_presentation_participant');
    }
}
