<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class usuarios extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $primaryKey = "idu";
    protected $fillable = ["idu", "nombre", "apellido", "user", "pasw", "tipo", "activo"];
}
