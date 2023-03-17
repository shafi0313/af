<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientFundRequest extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function ApprovedMedicines()
    {
        return $this->hasMany(RequestedMedicine::class);
    }
    // public function medicine()
    // {
    //     return $this->belongsTo(Medicine::class);
    // }
}
