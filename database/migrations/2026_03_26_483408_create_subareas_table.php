<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateSubareasTable extends Migration{
  public function up(){
    Schema::create('subareas', function (Blueprint $table) {
      $table->id();
      $table->string('nome')->nullable();
      $table->unsignedBigInteger('area_id');   
      $table->timestamps();
    });
    Schema::table('subareas', function (Blueprint $table) {
            $table->foreign('area_id')->references('id')->on('areas');
        });
  
  } 
  public function down(){ 
    Schema::dropIfExists('subareas');
  } 
} ?>
