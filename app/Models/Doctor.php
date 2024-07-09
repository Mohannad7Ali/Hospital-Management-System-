<?php

namespace App\Models;

use App\Http\Middleware\Authenticate;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Section;
use App\Models\Appointment;

class Doctor extends Authenticatable
{
    use HasFactory;
    use Translatable;

    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'name', 'section_id', 'section_id', 'Status'];
    public $translatedAttributes = ['name',];


    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function DoctorAppointment()
    {
        return $this->belongsToMany(Appointment::class, 'doctor_appointments');
    }
}
