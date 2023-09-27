<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model
{
    protected $table = 'absences';
    protected $primaryKey = ['idEtud','idSeance'];


    protected $fillable = ['idEtud', 'idSeance', 'absent'];
    use HasFactory;
}
 