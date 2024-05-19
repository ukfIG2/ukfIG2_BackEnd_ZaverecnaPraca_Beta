<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    use HasFactory;

    protected $fillable = ['title_id', 'first_name_id', 'middle_name_id', 'last_name_id', 'position', 'publish', 'email_id', 'phone_number'];

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

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    
}
