<?php
 namespace App\Http\Controllers;
 use App\Models\Subarea;
 use Illuminate\Database\QueryException;
 use Illuminate\Http\Request;
 use Illuminate\Support\Facades\Auth;
 use App\Models\Area;

 class SubareaController extends Controller 
 {
      function list($area_id,$msg=null){
         $filter = "";
         if(isset($_GET['filtro'])){
         $filter = $_GET['filtro'];
         }
            $lista = Subarea::where('area_id','=',$area_id)->orderBy('id', 'desc')->paginate(10);
            $area = area::find($area_id);
            return view('subarea/list',['lista'=>$lista,'filtro'=>$filter, 'area'=> $area,'msg'=>$msg]);
       } 
 function new($area_id){
     $area = Area::find($area_id);    
     return view('subarea/form',['entidade'=>new Subarea(),'area'=> $area]);
 } 
 function search(Request $request, $area_id){
    $area = Area::find($area_id);
    $filter = $request->query('filtro');
    $lista = Subarea::where('nome','like',"%".$request->filtro."%")->orderBy('id', 'desc')->paginate(10);
    return view('subarea/list',['lista'=>$lista,'filtro'=>$request->filtro,'area'=> $area ])->with('filter', $filter);
 } 
 function save(Request $request){
 $area_id =  $request->  area_id;
    if ($request -> id){
       $ent= Subarea::find ($request->id);
       $ent-> nome=$request-> nome;
       $ent-> area_id = $area_id;
       $ent-> save();
    } else {
        $entidade = Subarea::create ([
       'nome'=>$request-> nome,
       'area_id' => $area_id ]);
    } 
   $msg = ['valor'=>trans("Operação realizada com sucesso!"),'tipo'=>'success'];
    return $this->list($area_id, $msg);
 } 
 function  delete($id){
    $area_id = 0;
    try {
      $entidade = Subarea::find($id);   
      if ($entidade){
       $area_id = $entidade->area_id;
        $entidade->delete();
        $msg = ['valor'=>trans("Operação realizada com sucesso!"),'tipo'=>'success'];
      } else {
        $msg = ['valor'=>trans("Operação realizada com sucesso!"),'tipo'=>'success'];
      }
   }catch (QueryException $exp ){
      $msg = ['valor'=>$exp->getMessage(),'tipo'=>'primary'];
   }
    return $this->list($area_id, $msg);
 } 
 function  edit($id){
     $entidade = Subarea::find($id);   
     $area_id = $entidade->area_id;   
     $area = Area::find($area_id);   
      return view('subarea/form',['entidade'=>$entidade,'area'=> $area]);
    }   
   
 } ?>
