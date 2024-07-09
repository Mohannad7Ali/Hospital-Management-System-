<?php

namespace App\Models;

use App\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupInvoice extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function Group()
    {
        return $this->belongsTo(Group::class, 'Group_id', 'id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
}
