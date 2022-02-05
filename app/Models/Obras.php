<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obras extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $connection = "u868320945_projetorio";
    protected $table = "u868320945_projetorio.obras";  
}
