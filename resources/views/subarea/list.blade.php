@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('topo')
 
@endsection
@section('pesquisa')
  <form action="{{route('subarea.search',$area->id)}}" method="get" id="pesquisar">
     @csrf
     <div class="input-group no-border">
       <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro" id="filtro"
         @if(isset($filtro)) 
            value="{{$filtro}}"
         @endif  >
      <div class="input-group-append">
          <div class="input-group-text" onclick="document.getElementById('pesquisar').submit();">
           <i  class="now-ui-icons ui-1_zoom-bold"></i>
      </div>
    </div>
   </div>
@endsection
@section('conteudo')

   <a class="btn"  href="{{route('subarea.new',$area->id)}}">Nova SubÁrea de Atuação</a>

  <div class="row">

     <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                  <h4 class="card-title">SubÁreas de Atuação </h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
<table class="table"> 
  <thead>
     <th> Nome </th>
     <th  class="text-left" style="width: 180px;">    </th>
  </thead>
  <tbody>
  @if(sizeof($lista)>0)
    @foreach($lista as $ent)
      <tr>
          <td>{{$ent->nome}}</td> 
        <td  class="text-left" style="width: 180px;"> 
        <a rel="tooltip" title="Editar"
            class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
            data-original-title="Edit"
            href="{{route('subarea.edit',$ent->id)}}">
            <ion-icon name="create-outline"></ion-icon>
         </a>
         <a href="{{route('subarea.delete',$ent->id)}}"
            onclick="return confirm('Deseja relamente excluir?')"
            rel="tooltip"
            title="Excluir"
            class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral"
            data-original-title="Remove">
            <ion-icon name="trash-outline"></ion-icon>
         </a>
        </td> 
  @endforeach 
  @endif 
   </tbody> 
 </table> 

  
</div>
  <a href="{{route('area.list')}}" class="btn btn-primary"><i class="fa fa-reply"></i><span> Voltar</span></a>
 </div>
                 
@endsection