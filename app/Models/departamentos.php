<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class departamentos extends Model
{
    use HasFactory;
    // Se define el nombre de la llave primaria por que si no buscara una por defecto llamada 'id'
    protected $primaryKey = 'idd';
    protected $fillable = ['idd', 'nombre'];
}
