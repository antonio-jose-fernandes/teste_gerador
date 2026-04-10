<?php

namespace App\Http\Controllers;

use App\Models\Ensino;
use App\Models\PlanilhaEnsino;
use App\Models\Professor;
use App\Models\Semestre;
use App\Models\Distribuicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use PhpOffice\PhpWord\IOFactory;

class PdfController extends Controller
{
    public function gerarPdfPit(Request $request)
    {

       if($request->siape == null){
          return view('welcome');
       }
        $professor = Professor::where('siape', 'like', $request->siape)->
        where('nome', 'like', $request->nome)->
        orderBy('id', 'desc')->first();

        if($professor == null){
            //aqui mandar uma mensagem informando que não foi encontrado e sugerir fazer o cadastro.
            $msg = ['valor' => trans("SIAPE/NOME não encontrado."), 'tipo' => 'warning'];
            return view('welcome', ['msg' => $msg]);
        }

        //alterar para siape *****************************************************
        $listaEnsino = PlanilhaEnsino::where('professor', 'like', $professor->nome)->orderBy('id', 'desc')->get();


        $qtdHorasTecnico = PlanilhaEnsino::where('professor', 'like', $professor->nome)->
        where('curso', 'like', "TECNICO")->sum('horas');
        $qtdHorasSuperior = PlanilhaEnsino::where('professor', 'like', $professor->nome)->
        where('curso', 'like', "SUPERIOR")->sum('horas');
        $qtdHorasFic = PlanilhaEnsino::where('professor', 'like', $professor->nome)->
        where('curso', 'like', "FIC")->sum('horas');
        $qtdHorasDisciplina = $qtdHorasTecnico+$qtdHorasSuperior+$qtdHorasFic;

        //quantidade de horas por semana
      //$qtdHorasDisciplina = $qtdHorasDisciplina/20;
        if($qtdHorasDisciplina>20){
            $qtdHorasDisciplina = 20;
        }
        $atendimentoEstudante = ceil($qtdHorasDisciplina*0.2);
        $ensino = new Ensino();
        $ensino->qtdHoras = $qtdHorasDisciplina;
        $ensino->atendimentoEstudante = $atendimentoEstudante;
        $ensino->planejamento = $qtdHorasDisciplina - $atendimentoEstudante;
        $participacaoEncotrosPedagogicos = 2;
        $ensino->total = $ensino->qtdHoras+ $ensino->atendimentoEstudante+$ensino->planejamento+$participacaoEncotrosPedagogicos;


        $semestre = Semestre::latest()->first();
        return \PDF::loadView('relatorios/relPitProfessor', compact('listaEnsino', 'ensino',
            'professor','qtdHorasTecnico','qtdHorasSuperior','qtdHorasFic','semestre' ))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream();
    }

    public function gerarWordPit($siape)
    {

        $professor = Professor::where('siape', 'like', $siape)->orderBy('id', 'desc')->first();

        if($professor == null){
            //aqui mandar uma mensagem informando que não foi encontrado e sugerir fazer o cadastro.
            $msg = ['valor' => trans("SIAPE não encontrado, favor realizar cadastro."), 'tipo' => 'warning'];
            return view('welcome', ['msg' => $msg]);
        }

        //alterar para siape *****************************************************
        $listaEnsino = PlanilhaEnsino::where('professor', 'like', $professor->nome)->orderBy('id', 'desc')->get();


        $qtdHorasDisciplinaPonto1 = PlanilhaEnsino::where('professor', 'like', $professor->nome)->sum('horas');
        $qtdHorasDisciplinaPonto2 = 0; //PlanilhaEnsino::where('professor', 'like', $request->nome)->sum('horas');
        $qtdHorasDisciplinaPonto3 = 0;// PlanilhaEnsino::where('professor', 'like', $request->nome)->sum('horas');
        $qtdHorasDisciplina = $qtdHorasDisciplinaPonto1+$qtdHorasDisciplinaPonto2+$qtdHorasDisciplinaPonto3;

        //quantidade de horas por semana
        //$qtdHorasDisciplina = $qtdHorasDisciplina/20;
        if($qtdHorasDisciplina>20){
            $qtdHorasDisciplina = 20;
        }

        $atendimentoEstudante = ceil($qtdHorasDisciplina*0.2);

        $ensino = new Ensino();
        $ensino->qtdHoras = $qtdHorasDisciplina;
        $ensino->atendimentoEstudante = $atendimentoEstudante;
        $ensino->planejamento = $qtdHorasDisciplina - $atendimentoEstudante;
        $ensino->total = $ensino->qtdHoras+ $ensino->atendimentoEstudante+$ensino->planejamento;



       $pdf = \PDF::loadView('relatorios/relPitProfessor', compact('listaEnsino', 'ensino','professor'));
       $pdfContent = $pdf->output();

      //  dd($pdfContent);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText(file_get_contents($pdfContent));

        $writer = IOFactory::createWriter($phpWord, 'Word2007');
        $writer->save('documento.docx');

    }

    public function downloadDocumento()
    {

        $this->gerarWordPit(123);

        $filePath = storage_path('app/public/documento.docx');

        return response()->download($filePath, 'documento.docx')->deleteFileAfterSend();
    }

    public function gerarPdfDistribuicaoPorProfessor(Request $request)
    {
       
         $dados =  Distribuicao::whereNotNull('professor')
        ->where('professor', '!=', '')
        ->where('professor', '!=', '# Não Ofertada')
        ->where('professor', '!=', 'FALSE')
        ->where('professor', '!=', 'TRUE')
        ->where('professor', '!=', 'Seg')        
        ->where('professor', '!=', 'DISPONIBILIDADE')
        ->where('professor', '!=', '- - -')
        ->where('professor', '!=', 'professores: gestão')
        ->where('professor', '!=', 'professores: mecânica')
        ->where('professor', '!=', 'professor')
        ->where('semestre_id', $request->semestre_id)
        ->orderBy('professor')
        ->get()
        ->groupBy('professor');
        
       // dd($dados);


        return \PDF::loadView('relatorios/relDistribuicaoPorProfessor', compact('dados'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream();
    }

     public function gerarPdfDistribuicaoPorArea(Request $request)
    {

         $dados =  Distribuicao::whereNotNull('professor')
        ->where('professor', '!=', '')
        ->where('professor', '!=', '# Não Ofertada')
        ->where('professor', '!=', 'FALSE')
        ->where('professor', '!=', 'TRUE')
        ->where('professor', '!=', 'Seg')        
        ->where('professor', '!=', 'DISPONIBILIDADE')
        ->where('professor', '!=', '- - -')
        ->where('professor', '!=', 'professores: gestão')
        ->where('professor', '!=', 'professores: mecânica')
        ->where('professor', '!=', 'professor')
        ->where('semestre_id', $request->semestre_id)
        ->orderBy('professor')
        ->get()
        ->groupBy('professor');


        $professores =  Professor::whereNotNull('area_id')   
        ->where('nome', '!=', 'Nome')    
        ->orderBy('area_id')
        ->get()
        ->groupBy('area_id');

       


        return \PDF::loadView('relatorios/relDistribuicaoPorArea', compact('professores','dados'))
            // Se quiser que fique no formato a4 retrato: ->setPaper('a4', 'landscape')
            ->stream();
    }

    public function formRelProfessores(Request $request)
    {
        $semestres = Semestre::orderBy('id', 'desc')->get();
        return view('relatorios/formRelPorProfessor', ['semestres' => $semestres]);
    }

     public function formRelArea(Request $request)
    {
        $semestres = Semestre::orderBy('id', 'desc')->get();
        return view('relatorios/formRelPorArea', ['semestres' => $semestres]);
    }

     public function formRelSemestre(Request $request)
    {
        $semestres = Semestre::orderBy('id', 'desc')->get();
        return view('relatorios/formRelPorSemestre', ['semestres' => $semestres]);
    }

    

    public function gerarPdfPorSemestre(Request $request)
    {

         $dados =  Distribuicao::whereNotNull('professor')
        ->where('professor', '!=', '')
        ->where('professor', '!=', '# Não Ofertada')
        ->where('professor', '!=', 'FALSE')
        ->where('professor', '!=', 'TRUE')
        ->where('professor', '!=', 'Seg')        
        ->where('professor', '!=', 'DISPONIBILIDADE')
        ->where('professor', '!=', '- - -')
        ->where('professor', '!=', 'professores: gestão')
        ->where('professor', '!=', 'professores: mecânica')
        ->where('professor', '!=', 'professor')
        ->whereIn('semestre_id', $request->semestre_id)
        ->orderBy('professor')
        ->get()
        ->groupBy([
            'professor',
            'semestre_id'
        ]);

        $professores =  Professor::whereNotNull('area_id')   
        ->where('nome', '!=', 'Nome')    
        ->orderBy('area_id')
        ->get()
        ->groupBy('area_id');

        $semestresSelecionados = Semestre::whereIn('id', $request->semestre_id)->get();

        return \PDF::loadView(
            'relatorios/relDistribuicaoPorSemestre',
            compact('professores','dados','semestresSelecionados')
        )->stream();
        
    }

    

}
