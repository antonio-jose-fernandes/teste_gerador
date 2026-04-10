<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSemestresTable extends Migration{
  public function up(){
    Schema::create('semestres', function (Blueprint $table) {
      $table->id();
      $table->string('descricao')->nullable()->unique();
      $table->timestamps();
    });
  } 
  public function down(){ 
    Schema::dropIfExists('semestres');
  } 
} ?>
