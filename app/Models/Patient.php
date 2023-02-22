<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function medicines()
    {
        return $this->hasMany(Medicine::class, 'patient_id', 'id');
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function getThana()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
}
