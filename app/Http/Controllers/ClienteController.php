<?php
namespace App\Http\Controllers;
use App\Models\Cliente;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
class ClienteController extends Controller
{
   function list($msg = null)
   {
      $filter = "";
      $lista = Cliente::where('nome', 'like', "%" . "%")->orderBy('id', 'desc')->paginate(8);
      return view('cliente/list', ['lista' => $lista, 'filtro' => $filter, 'msg' => $msg]);
   }
   function create()
   {
      return view('cliente/form', ['entidade' => new Cliente()]);
   }
   function search(Request $request)
   {
      $filter = $request->query('filtro');
      $lista = Cliente::where('nome', 'like', "%" . $request->filtro . "%")->orderBy('id', 'desc')->paginate(8);
      return view('cliente/list', ['lista' => $lista, 'filtro' => $request->filtro])->with('filter', $filter);
   }
   function store(Request $request)
   {
      $request->validate([
         'nome' => 'required|string|max:255',
         'telefone' => 'required|string|max:255',
      ]);
      if ($request->id) {
         $ent = Cliente::findOrFail($request->id);
         $ent->nome = $request->nome;
         $ent->telefone = $request->telefone;
         $ent->save();
      } else {
         $entidade = Cliente::create([
            'nome' => $request->nome,
            'telefone' => $request->telefone
         ]);
      }
      $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
      return $this->list($msg);
   }
   function delete($id)
   {
      try {
         $entidade = Cliente::findOrFail($id);
         if ($entidade) {
            $entidade->delete();
            $msg = ['valor' => trans("Operação realizada com sucesso!"), 'tipo' => 'success'];
         }
      } catch (QueryException $exp) {
         $msg = ['valor' => 'Erro ao excluir registro.', 'tipo' => 'primary'];
      }
      return $this->list($msg);
   }
   function edit($id)
   {
      $entidade = Cliente::findOrFail($id);
      return view('cliente/form', ['entidade' => $entidade]);
   }

} ?>