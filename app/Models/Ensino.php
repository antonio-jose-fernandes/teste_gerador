<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ensino extends Model
{
    use HasFactory;

    protected $fillable = ['qtdHoras','atendimentoEstudante','planejamento','total'];
}
