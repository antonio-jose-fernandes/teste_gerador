<?php
namespace App\Http\Controllers;

use App\Imports\PesquisaPlanilhaImport;
use App\Imports\ExtensaoPlanilhaImport;
use App\Imports\GestaoPlanilhaImport;
use App\Models\PlanilhaEnsino;
use App\Models\Professor;
use App\Models\PlanilhaGestao;
use App\Models\PlanilhaPesquisa;
use App\Models\Semestre;
use App\Models\Area;
use App\Models\Subarea;
use App\Models\Distribuicao;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EnsinoPlanihaImport;
use Maatwebsite\Excel\Excel as ExcelType;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SemestreController extends Controller
{


    public function DisponibilidadeImportarPlanilha(Request $request)
    {
        //versao para varias planilhas
        $arquivos = $request->file('planilhas');

        $semestre_id = $request->semestre_id;

        //deletando os registro do semestre, caso já tenha feito essa operacao 1 vez
        //ou seja, se for de semestre diferente nao apaga
        Distribuicao::where('semestre_id', $semestre_id)->delete();

        foreach ($arquivos as $planilha) {

            $spreadsheet = IOFactory::load($planilha);

            foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                $nomeAba = $worksheet->getTitle();
                $linhas = $worksheet->toArray();
                foreach ($linhas as $row) {
                    $nomeProfessor = isset($row[9]) ? trim($row[9]) : null;     
                    /*
                    agora eu estou pegando os prefessores pela importacao da planilha
                    if ($nomeProfessor) {
                            $professor = Professor::firstOrCreate([
                                'nome' => $nomeProfessor
                            ]);                        
                    } */ 
                   
                    //buscando professor
                    if ($nomeProfessor) {
                        $professorEntidade = Professor::where('nome', 'like', "%" .$nomeProfessor. "%")->first();

                        if($professorEntidade) {                           
                            Distribuicao::create([
                                'eixo' => $row[2] ?? null,
                                'disciplina' => $row[4] ?? null,
                                'cr' => $row[5] ?? null,
                                'professor' => $professorEntidade->nome,
                                'curso' => $nomeAba,
                                'semestre_id' => $semestre_id,
                            ]);
                        }
                    }
                }
            }
        }
        /* versao para 1 planilha
        $planilha = $request->file('planilha');
        $spreadsheet = IOFactory::load($planilha);
        Distribuicao::truncate();
        foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {

            $nomeAba = $worksheet->getTitle();
            $linhas = $worksheet->toArray();

            foreach ($linhas as $row) {

                Distribuicao::create([
                    'eixo' => $row[2] ?? null,
                    'disciplina' => $row[4] ?? null,
                    'cr' => $row[5] ?? null,
                    'professor' => $row[9] ?? null,
                    'curso' =>  $nomeAba, 
                ]);
            }
        }

        */
        /*
        $planilha = $request->file('planilha');
        PlanilhaEnsino::truncate();

        $sheets = Excel::toCollection(null, $planilha);

        foreach ($sheets as $nomeAba => $linhas) {

            foreach ($linhas as $row) {

                PlanilhaEnsino::create([
                    'siape' => $row[4] ?? null,
                    'professor' => $row[5] ?? null,
                    'curso' => $nomeAba, // 👈 nome da aba
                    'disciplina' => $row[9] ?? null,
                    'horas' => 1, // pode adaptar seu cálculo aqui
                ]);
            }
        } */
     //   Excel::import(new EnsinoPlanihaImport(), $planilha);

        if ($request->hasFile('planilhas')) {
            // Faça o que precisa com a planilha aqui, como ler e processar seus dados
        } else {
            return redirect()->back()->withErrors(['error' => 'Nenhuma planilha foi enviada.']);
        }
        $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
        return view('layout', ['msg' => $msg]);
    }

     public function DadosProfessorImportarPlanilha(Request $request)
    {
        if ($request->hasFile('planilha')) {

            $planilha = $request->file('planilha');
        
            $sheets = Excel::toCollection(null, $planilha);

            //zerando as tabelas de professor e Área
            Professor::truncate();
           // Area::query()->delete();
            foreach ($sheets as $nomeAba => $linhas) {
                foreach ($linhas as $row) {
                    $nomeProfessor = isset($row[3]) ? trim($row[3]) : null;     
                        if ($nomeProfessor) {
                            $area = Area::firstOrCreate([
                                    'nome' =>$row[2] ?? null
                                ]);
                                $professor = Professor::firstOrCreate([
                                    'nome' => $nomeProfessor,
                                    'siape' => $row[1] ?? null,
                                    'area_id' => $area->id
                                ]);                        
                        }                
                }
            } 
        } else {
            return redirect()->back()->withErrors(['error' => 'Nenhuma planilha foi enviada.']);
        }
        $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
        return view('layout', ['msg' => $msg]);
    }

    public function formEnsino(Request $request)
    {
        $semestres = Semestre::orderBy('id', 'desc')->get();
        return view('importar/form', ['semestres' => $semestres]);
    }

    public function formImportProfessores(Request $request)
    {
        return view('importar/formDadosProfessores');
    }

    

    public function formPesquisa(Request $request)
    {
        return view('importar/formPesquisa', ['entidade' => new Semestre()]);
    }

    public function formExtensao(Request $request)
    {
        return view('importar/formExtensao', ['entidade' => new Semestre()]);
    }

    public function formGestao(Request $request)
    {
        return view('importar/formGestao', ['entidade' => new Semestre()]);
    }

    function configura()
    {
        $entidade = Semestre::latest()->first();
        return view('semestre/form', ['entidade' => $entidade]);
    }

    function save(Request $request)
    {
        try{       
            if ($request->id) {
                $ent = Semestre::find($request->id);
                $ent->descricao = $request->descricao;
                $ent->save();
            } else {
                $entidade = Semestre::create([
                    'descricao' => $request->descricao]);
            }
            $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
        } catch (QueryException $exp) {
            $msg = ['valor' => trans("Erro ao salvar! Semestre já existente"), 'tipo' => 'primary'];
            return back()->withInput()->with('msg', $msg);
        }

        return $this->list($msg);
    }

    function delete($id)
    {
        try {
            $entidade = Semestre::find($id);
            if ($entidade) {
                $entidade->delete();
                $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
            } else {
                $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
            }
        } catch (QueryException $exp) {
            $msg = ['valor' => $exp->getMessage(), 'tipo' => 'primary'];
        }
        return $this->list($msg);
    }

    function list($msg = null)
    {
        $filter = "";
        if (isset($_GET['filtro'])) {
            $filter = $_GET['filtro'];
        }
        $lista = Semestre::where('descricao', 'like', "%" . "%")->orderBy('id', 'desc')->paginate(50);
      
        return view('semestre/list', ['lista' => $lista,  'filtro' => $filter, 'msg' => $msg]);
    }

    function create()
   {
      return view('semestre/form', ['entidade' => new Semestre()]);
   }

    function edit($id)
   {
      $entidade = Semestre::find($id);
      return view('semestre/form', ['entidade' => $entidade]);
   }

    public function welcome(Request $request)
    {
        $semestres = Semestre::orderBy('id', 'desc')->get();
        return view('welcome', ['semestres' => $semestres]);
    }

} ?>
