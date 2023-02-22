<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded = ["id"];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'disctrict', 'id');
    }

    public function getThana()
    {
        return $this->belongsTo(Upazila::class, 'thana', 'id');
    }

}
