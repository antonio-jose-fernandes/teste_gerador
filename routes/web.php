<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get("/",[\App\Http\Controllers\UsuarioController::class,'preLogin'])->name('login');

Route::get("/cliente/list",[\App\Http\Controllers\ClienteController::class,'list'])->name('cliente.list')->middleware('auth');
Route::get("/cliente/new",[\App\Http\Controllers\ClienteController::class,'create'])->name('cliente.new')->middleware('auth');
Route::post("/cliente/search",[\App\Http\Controllers\ClienteController::class,'search'])->name('cliente.search')->middleware('auth');
Route::post("/cliente/save",[\App\Http\Controllers\ClienteController::class,'store'])->name('cliente.save')->middleware('auth');
Route::delete("/cliente/delete/{id}",[\App\Http\Controllers\ClienteController::class,'delete'])->name('cliente.delete')->middleware('auth');
Route::get("/cliente/edit/{id}",[\App\Http\Controllers\ClienteController::class,'edit'])->name('cliente.edit')->middleware('auth');



//AQUI A TELA DE LOGIN = PARA INICAR PELO WELCOME
//Route::get("/login",[\App\Http\Controllers\UsuarioController::class,'preLogin'])->name('login');
//Route::get('/',[\App\Http\Controllers\SemestreController::class,'welcome'] )->name('welcome');

Route::get("/logout",[\App\Http\Controllers\UsuarioController::class,'logout'])->name('logout');
Route::any("/home",[\App\Http\Controllers\UsuarioController::class,'logar'])->name('logar');

Route::get("/semestre/configura}",[\App\Http\Controllers\SemestreController::class,'configura'])->name('semestre.configura')->middleware('auth');
Route::post("/semestre/save",[\App\Http\Controllers\SemestreController::class,'save'])->name('semestre.save')->middleware('auth');
Route::get("/semestre/list",[\App\Http\Controllers\SemestreController::class,'list'])->name('semestre.list')->middleware('auth');
Route::get("/semestre/new",[\App\Http\Controllers\SemestreController::class,'create'])->name('semestre.new')->middleware('auth');
Route::get("/semestre/search",[\App\Http\Controllers\SemestreController::class,'search'])->name('semestre.search')->middleware('auth');
Route::get("/semestre/delete/{id}",[\App\Http\Controllers\SemestreController::class,'delete'])->name('semestre.delete')->middleware('auth');
Route::get("/semestre/edit/{id}",[\App\Http\Controllers\SemestreController::class,'edit'])->name('semestre.edit')->middleware('auth');


Route::any("/semestre/importdisp",[\App\Http\Controllers\SemestreController::class,'DisponibilidadeImportarPlanilha'])->name('semestre.ensino_import')->middleware('auth');
Route::any("/semestre/importarprofessores",[\App\Http\Controllers\SemestreController::class,'DadosProfessorImportarPlanilha'])->name('semestre.dados_professor_import')->middleware('auth');

//Route::any("/semestre/importteaching",[\App\Http\Controllers\SemestreController::class,'ensinoImportarPlanilha'])->name('semestre.ensino_import')->middleware('auth');
Route::any("/semestre/importsearch",[\App\Http\Controllers\SemestreController::class,'pesquisaImportarPlanilha'])->name('semestre.pesquisa_import')->middleware('auth');
Route::any("/semestre/importtextension",[\App\Http\Controllers\SemestreController::class,'extensaoImportarPlanilha'])->name('semestre.extensao_import')->middleware('auth');
Route::any("/semestre/importtmanagement",[\App\Http\Controllers\SemestreController::class,'gestaoImportarPlanilha'])->name('semestre.gestao_import')->middleware('auth');


Route::any("/importar/distribuicao",[\App\Http\Controllers\SemestreController::class,'formEnsino'])->name('import.formEnsino')->middleware('auth');
Route::any("/importar/professores",[\App\Http\Controllers\SemestreController::class,'formImportProfessores'])->name('import.formProfessores')->middleware('auth');
Route::any("/import/importtsearch",[\App\Http\Controllers\SemestreController::class,'formPesquisa'])->name('import.formPesquisa')->middleware('auth');
Route::any("/import/importtextension",[\App\Http\Controllers\SemestreController::class,'formExtensao'])->name('import.formExtensao')->middleware('auth');
Route::any("/import/importtmanagement",[\App\Http\Controllers\SemestreController::class,'formGestao'])->name('import.formGestao')->middleware('auth');




Route::any("/generator/professor",[\App\Http\Controllers\PdfController::class,'gerarPdfDistribuicaoPorProfessor'])->name('relatorio.distribuicaoprofessor');
Route::any("/generator/area",[\App\Http\Controllers\PdfController::class,'gerarPdfDistribuicaoPorArea'])->name('relatorio.distribuicaoarea');
Route::any("/generator/semestre",[\App\Http\Controllers\PdfController::class,'gerarPdfPorSemestre'])->name('relatorio.gerarPdfPorSemestre');
Route::any("/relatorio/professor",[\App\Http\Controllers\PdfController::class,'formRelProfessores'])->name('relatorio.formRelProfessores')->middleware('auth');
Route::any("/relatorio/area",[\App\Http\Controllers\PdfController::class,'formRelArea'])->name('relatorio.formRelArea')->middleware('auth');
Route::any("/relatorio/semestre",[\App\Http\Controllers\PdfController::class,'formRelSemestre'])->name('relatorio.formRelSemestre')->middleware('auth');


Route::any("/generator/pitpdf",[\App\Http\Controllers\PdfController::class,'gerarPdfPit'])->name('relatorio.pitprofessor');



Route::get("/professor/list",[\App\Http\Controllers\ProfessorController::class,'list'])->name('professor.list')->middleware('auth');
Route::get("/professor/new",[\App\Http\Controllers\ProfessorController::class,'new'])->name('professor.new')->middleware('auth');
Route::get("/teacher/new",[\App\Http\Controllers\ProfessorController::class,'newFrente'])->name('professor.newFrente');
Route::post("/teacher/savef",[\App\Http\Controllers\ProfessorController::class,'saveFrente'])->name('professor.saveFrente');
Route::get("/professor/search",[\App\Http\Controllers\ProfessorController::class,'search'])->name('professor.search')->middleware('auth');
Route::post("/professor/save",[\App\Http\Controllers\ProfessorController::class,'save'])->name('professor.save')->middleware('auth');
Route::get("/professor/delete/{id}",[\App\Http\Controllers\ProfessorController::class,'delete'])->name('professor.delete')->middleware('auth');
Route::get("/professor/edit/{id}",[\App\Http\Controllers\ProfessorController::class,'edit'])->name('professor.edit')->middleware('auth');

Route::post("/professor/update-area", [\App\Http\Controllers\ProfessorController::class, 'updateArea'])->name('professor.updateArea')->middleware('auth');
Route::post("/professor/update-area", [\App\Http\Controllers\ProfessorController::class, 'updateSubArea'])->name('professor.updateSubArea')->middleware('auth');
Route::post('/professor/update-cargo', [\App\Http\Controllers\ProfessorController::class, 'updateCargo'])->name('professor.updateCargo')->middleware('auth');

Route::any("/generator/download_docx",[\App\Http\Controllers\PdfController::class,'downloadDocumento'])->name('relatorio.downloadDocumento');

Route::get("/area/list",[\App\Http\Controllers\AreaController::class,'list'])->name('area.list')->middleware('auth');
Route::get("/area/new",[\App\Http\Controllers\AreaController::class,'create'])->name('area.new')->middleware('auth');
Route::post("/area/search",[\App\Http\Controllers\AreaController::class,'search'])->name('area.search')->middleware('auth');
Route::post("/area/save",[\App\Http\Controllers\AreaController::class,'store'])->name('area.save')->middleware('auth');
Route::get("/area/delete/{id}",[\App\Http\Controllers\AreaController::class,'delete'])->name('area.delete')->middleware('auth');
Route::get("/area/edit/{id}",[\App\Http\Controllers\AreaController::class,'edit'])->name('area.edit')->middleware('auth');

Route::get("/subarea/list/{area_id}",[\App\Http\Controllers\SubareaController::class,'list'])->name('subarea.list')->middleware('auth');
Route::get("/subarea/new/{area_id}",[\App\Http\Controllers\SubareaController::class,'new'])->name('subarea.new')->middleware('auth');
Route::get("/subarea/search/{area_id}",[\App\Http\Controllers\SubareaController::class,'search'])->name('subarea.search')->middleware('auth');
Route::post("/subarea/save/{area_id}",[\App\Http\Controllers\SubareaController::class,'save'])->name('subarea.save')->middleware('auth');
Route::get("/subarea/delete/{id}",[\App\Http\Controllers\SubareaController::class,'delete'])->name('subarea.delete')->middleware('auth');
Route::get("/subarea/edit/{id}",[\App\Http\Controllers\SubareaController::class,'edit'])->name('subarea.edit')->middleware('auth');
