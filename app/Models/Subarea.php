<?php
namespace App\Models;
 use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Subarea extends Model{
  use HasFactory;
  protected $fillable = ['nome','area_id'];
  public function area()
    {
        return $this->belongsTo(Area::class);
    }
} ?>