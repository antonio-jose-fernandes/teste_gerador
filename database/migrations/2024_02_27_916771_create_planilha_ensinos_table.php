<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanilhaEnsinosTable extends Migration
{
    public function up()
    {
        Schema::create('planilha_ensinos', function (Blueprint $table) {
            $table->id();
            $table->string('siape')->nullable();
            $table->string('professor')->nullable();
            $table->string('curso')->nullable();
            $table->string('disciplina')->nullable();
            $table->string('horas')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('planilha_ensinos');
    }
} ?>
