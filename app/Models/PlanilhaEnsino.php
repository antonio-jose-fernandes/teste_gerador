<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanilhaEnsino extends Model
{
    use HasFactory;

    protected $fillable = ['siape','professor','curso','disciplina','horas'];
}
