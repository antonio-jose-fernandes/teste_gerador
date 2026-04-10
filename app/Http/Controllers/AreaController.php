<?php
namespace App\Http\Controllers;
use App\Models\Area;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaController extends Controller
{
   function list($msg = null)
   {
      $filter = "";
      if (isset($_GET['filtro'])) {
         $filter = $_GET['filtro'];
      }
      $lista = Area::where('nome', 'like', "%" . "%")
       ->where('nome', '!=', 'Área')
      ->orderBy('nome', 'asc')->paginate(12);
      return view('area/list', ['lista' => $lista, 'filtro' => $filter, 'msg' => $msg]);
   }
   function create()
   {
      return view('area/form', ['entidade' => new Area()]);
   }
   function search(Request $request)
   {
      $filter = $request->query('filtro');
      $lista = Area::where('nome', 'like', "%" . $request->filtro . "%")->orderBy('id', 'desc')->paginate(8);
      return view('area/list', ['lista' => $lista, 'filtro' => $request->filtro])->with('filter', $filter);
   }
   function store(Request $request)
   {
      if ($request->id) {
         $ent = Area::find($request->id);
         $ent->nome = $request->nome;
         $ent->save();
      } else {
         $entidade = Area::create([
            'nome' => $request->nome
         ]);
      }
      $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
      return $this->list($msg);
   }
   function delete($id)
   {
      try {
         $entidade = Area::find($id);
         if ($entidade) {
            $entidade->delete();
            $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
         }
      } catch (QueryException $exp) {
         $msg = ['valor' => $exp->getMessage(), 'tipo' => 'primary'];
      }
      return $this->list($msg);
   }
   function edit($id)
   {
      $entidade = Area::find($id);
      return view('area/form', ['entidade' => $entidade]);
   }

} ?>