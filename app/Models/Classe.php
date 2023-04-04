<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $primaryKey = 'idClasse';

    public function formation()
    {
        return $this->belongsTo(Formation::class, 'idFormation');
    }

    public function prof()
    {
        return $this->belongsTo(Prof::class, 'idProf');
    }
    public function professor()
    {
        return $this->belongsTo(Prof::class, 'idProf');
    }
    
    use HasFactory;
}
