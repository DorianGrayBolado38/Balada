<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    protected $primarykey = 'idEvento';
    use HasFactory;
    protected $fillable =[
        'nomeEvento',
        'dataEvento',
        'localEvento',
        'imgEvento',
    ];
}
