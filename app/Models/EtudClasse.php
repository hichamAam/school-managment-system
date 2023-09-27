<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtudClasse extends Model
{
    protected $table = 'etud_classes';

    protected $fillable = ['idEtud', 'idClass'];

    use HasFactory;
}
