<?php
namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\Area;
use App\Models\Subarea;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{
    function list($msg = null)
    {
        $filter = "";
        if (isset($_GET['filtro'])) {
            $filter = $_GET['filtro'];
        }
        $lista = Professor::where('nome', 'like', "%" . "%")
         ->where('nome', '!=', '')
        ->where('nome', '!=', '# Não Ofertada')
        ->where('nome', '!=', 'FALSE')
        ->where('nome', '!=', 'TRUE')
        ->where('nome', '!=', 'Seg')        
        ->where('nome', '!=', 'DISPONIBILIDADE')
        ->where('nome', '!=', '- - -')
        ->where('nome', '!=', 'professores: gestão')
         ->where('nome', '!=', 'professor')
         ->where('nome', '!=', 'professores')
        ->where('nome', '!=', 'professores: mecânica')
        ->orderBy('nome', 'asc')->paginate(200);

        $areas = Area::all(); // tabela de áreas

         $subareas = Subarea::orderBy('nome', 'asc')->get(); // tabela de áreas
        return view('professor/list', ['lista' => $lista,'areas'=>$areas , 'subareas'=>$subareas , 'filtro' => $filter, 'msg' => $msg]);
    }

    function new()
    {

        return view('professor/form', ['entidade' => new Professor()]);
    }

    function newFrente()
    {
        return view('formFrente', ['entidade' => new Professor()]);
    }

    function saveFrente(Request $request)
    {
        if ($request->id) {
            $ent = Professor::find($request->id);
            $ent->nome = $request->nome;
            $ent->campus = 'Sobral';
            $ent->siape = $request->siape;
            $ent->tipo_vinculo = $request->tipo_vinculo;
            $ent->regime_trabalho = $request->regime_trabalho;
            $ent->departamento = $request->departamento;
            $ent->area = $request->area;
            $ent->save();
        } else {
            $entidade = Professor::create([
                'nome' => $request->nome,
                'campus' => 'Sobral',
                'siape' => $request->siape,
                'tipo_vinculo' => $request->tipo_vinculo,
                'regime_trabalho' => $request->regime_trabalho,
                'departamento' => $request->departamento,
                 'area' => $request->area]);
        }
        $msg = ['valor' => trans("Operação realizada com sucesso! Agora digite o seu SIAPE e clique em Gerar PDF"), 'tipo' => 'success'];
        return view('welcome', ['msg' => $msg]);
    }

    function search(Request $request)
    {
        $filter = $request->query('filtro');
        $lista = Professor::where('nome', 'like', "%" . $request->filtro . "%")->orderBy('id', 'desc')->paginate(10);
        return view('professor/list', ['lista' => $lista, 'filtro' => $request->filtro])->with('filter', $filter);
    }

    function save(Request $request)
    {
        if ($request->id) {
            $ent = Professor::find($request->id);
            $ent->nome = $request->nome;
            $ent->campus = 'Sobral';
            $ent->siape = $request->siape;
            $ent->tipo_vinculo = $request->tipo_vinculo;
            $ent->regime_trabalho = $request->regime_trabalho;
            $ent->departamento = $request->departamento;
             $ent->area_id = $request->area_id;
             $ent->subarea_id = $request->subarea_id;
            $ent->save();
        } else {
            $entidade = Professor::create([
                'nome' => $request->nome,
                'campus' => 'Sobral',
                'siape' => $request->siape,
                'tipo_vinculo' => $request->tipo_vinculo,
                'regime_trabalho' => $request->regime_trabalho,
                'departamento' => $request->departamento,
                 'area_id' => $request->area_id,
                 'subarea_id' => $request->subarea_id]);
        }
        $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
        return $this->list($msg);
    }

    function delete($id)
    {
        try {
            $entidade = Professor::find($id);
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

    function edit($id)
    {
        $entidade = Professor::find($id);
        $areas = Area::orderBy('nome')->get();
        $subareas = Subarea::orderBy('nome')->get();

        return view('professor/form', compact('areas', 'subareas','entidade'));
       // return view('professor/form', ['entidade' => $entidade]);
    }

    public function updateArea(Request $request)
    {       
        $professor = Professor::find($request->id);
        if ($professor) {
           
            $area = Area::find($request->area_id);
            $professor->area_id = $area->id;
            $professor->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }

     public function updateSubArea(Request $request)
    {       
        $professor = Professor::find($request->id);
        if ($professor) {
           
            $subarea = Subarea::find($request->subarea_id);
            $professor->subarea_id = $subarea->id;
            $professor->save();

            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false], 404);
    }


    public function updateCargo(Request $request)
    {
        $professor = Professor::find($request->id);

        if (!$professor) {
            return response()->json(['success' => false], 404);
        }

        $professor->possui_cargo = $request->possui_cargo;
        $professor->save();

        return response()->json(['success' => true]);
    }
    
} ?>
