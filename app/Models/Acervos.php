<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acervos extends Model
{
    use HasFactory;

    public $timestamps    = false;
    protected $connection = "u868320945_projetorio";
    protected $table = "u868320945_projetorio.acervos";  
}
