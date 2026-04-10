<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Professor extends Model{
  use HasFactory;
  protected $fillable = ['nome','campus','siape','tipo_vinculo','regime_trabalho','departamento','area_id','subarea_id','possui_cargo'];
 
} ?>