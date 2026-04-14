<?php
 namespace App\Http\Controllers;
 use App\Models\Cliente;
 use Illuminate\Database\QueryException;
 use Illuminate\Http\Request;
 class ClienteController extends Controller 
 {
 function list(Request $request,$msg=null){
    $filtro = $request->input('filtro');
    $query = Cliente::query();
    if (!empty($filtro)) {
        $query->where('nome','like',"%{$filtro}%");
    }
     $lista = $query->orderBy('id', 'desc')->paginate(8);
     return view('cliente/list',['lista'=>$lista,'filtro'=>$filtro,'msg' => $msg]);
 } 
 function create(){
     return view('cliente/form',['entidade'=>new Cliente()]);
 } 
 function search(Request $request){
    $filtro = $request->input('filtro');
    $lista = Cliente::where('nome','like',"%{$filtro}%")->orderBy('id', 'desc')->paginate(8);
    return view('cliente/list',['lista'=>$lista,'filtro'=>$filtro])->with('filtro', $filtro);
 } 
 function store(Request $request){
    $request->validate([
        'nome' => 'required|string|max:255', 
        'tipo' => 'required|string|max:255', 
   ]); 
    if ($request -> id){
       $ent= Cliente::findOrFail ($request->id);
       $ent-> nome=$request-> nome;
       $ent-> tipo=$request-> tipo;
       $ent-> save();
    } else {
        $entidade = Cliente::create ([
       'nome'=>$request-> nome,
       'tipo'=>$request-> tipo ]);
    } 
   $msg = ['valor'=>trans("Operação realizada com sucesso!"),'tipo'=>'success'];
    return  redirect()->route('cliente.list')->with('msg', $msg);    
 } 
 function  delete($id){
    try {
    $entidade = Cliente::findOrFail($id);   
    $entidade->delete();
    $msg = ['valor'=>trans("Operação realizada com sucesso!"),'tipo'=>'success'];
   }catch (QueryException $exp ){
      $msg = ['valor'=> 'Erro ao excluir registro.','tipo'=>'primary'];
      \Log::error($exp->getMessage());
   }
    return  redirect()->route('cliente.list')->with('msg', $msg);    
 } 
 function  edit($id){
    $entidade = Cliente::findOrFail($id);   
      return view('cliente/form',['entidade'=>$entidade]);
    }   
   
 } ?>
