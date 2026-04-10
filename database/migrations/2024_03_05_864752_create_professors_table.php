<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateProfessorsTable extends Migration{
  public function up(){
    Schema::create('professors', function (Blueprint $table) {
      $table->id();
      $table->string('nome')->nullable()->unique();
      $table->string('campus')->nullable();
      $table->string('siape')->nullable();
      $table->string('tipo_vinculo')->nullable();
      $table->string('regime_trabalho')->nullable();
      $table->string('departamento')->nullable();
      $table->string('area_id')->nullable();
      $table->string('subarea_id')->nullable();
       $table->boolean('possui_cargo')->default(false);
      $table->timestamps();
    });
  } 
  public function down(){ 
    Schema::dropIfExists('professors');
  } 
} ?>
