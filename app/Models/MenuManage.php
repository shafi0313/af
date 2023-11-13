<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuManage extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $table = "menu_manages";

    protected $dates = ['recept_date'];
}
