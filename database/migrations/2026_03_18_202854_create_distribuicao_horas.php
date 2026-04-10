<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('distribuicaos', function (Blueprint $table) {
            $table->id();            
            $table->string('eixo')->nullable();
            $table->string('disciplina')->nullable();
            $table->string('cr')->nullable();
            $table->string('professor')->nullable(); 
            $table->string('curso')->nullable();    
            $table->integer('semestre_id')->nullable();           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribuicao_horas');
    }
  
};
