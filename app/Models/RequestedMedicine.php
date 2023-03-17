<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedMedicine extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function getMedicine()
    {
        return $this->belongsTo(Medicine::class, 'medicine_id','id');
    }
}
