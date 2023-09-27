<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $primaryKey = 'idCours';

    use HasFactory;

    //protected $fillable = ['name', 'idProf', 'idClasse', 'path'];
}
