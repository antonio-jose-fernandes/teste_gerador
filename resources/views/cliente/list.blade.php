@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
<div class="card">

  <div class="row">

     <div class="col-lg-12 col-md-12">
         <div class="card card-tasks">
            <div class="card-header">
                  <h6 class="title d-inline">Lista de cliente </h6>
<div class="dropdown">
<button type="button" class="btn btn-link dropdown-toggle btn-icon" data-toggle="dropdown">
   <i class="tim-icons icon-settings-gear-63"></i>
 </button>
 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
     <a class="dropdown-item" href="{{route('cliente.new')}}">Adicionar</a>
 </div>
</div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
<table class="table"> 
  <thead>
     <th> Nome </th>

     <th> Tipo </th>
     <th>    </th>
  </thead>
  <tbody>
  @if(sizeof($lista)>0)
    @foreach($lista as $ent)
      <tr>
          <td>{{$ent->nome}}</td> 

          <td>{{$ent->tipo}}</td> 
        <td> 
        <a rel="tooltip" title="Editar" class="btn btn-link" data-original-title="Edit" href="{{route('cliente.edit',$ent->id)}}"> 
           <i class="tim-icons icon-pencil"></i> 
        </a> 
        </td> 
        <td> 
           <form action="{{route('cliente.delete',$ent->id)}}" method="POST" style="display:inline;"
             onsubmit="return confirm('Deseja realmente excluir?')"> 
             @csrf 
             @method('DELETE') 
             <button type="submit" class="btn btn-link"> 
                 <ion-icon name="trash-outline"></ion-icon> 
             </button> 
            </form> 
         </td> 
  @endforeach 
  @endif 
   </tbody> 
 </table> 
           <div>
            {{$lista->appends(request()->query())->links()}}
           </div>           </div>
            </div>
        </div>
     </div>
   </div>
@endsection
