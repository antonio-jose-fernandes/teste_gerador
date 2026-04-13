
@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('topo')
 
@endsection
@section('pesquisa')
  <form action="{{route('area.search')}}" method="get" id="pesquisar">
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
  <div class="row">

    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          <h5 class="title">Editar</h5>
        </div>
        <div class="card-body">
          <form method="post" action="{{route('cliente.save')}}">
            @csrf

            <div class="col-md-12 px-8">
              <div class="form-group">
                <label id="labelFormulario">Nome</label>
                <input style="border-color: #C0C0C0" type="text" class="form-control" name="nome" required
                  value="{{old('nome', $entidade->nome)}}" maxlength="150">

              </div>
            </div>
            <div class="col-md-12 px-8">
              <div class="form-group">
                <label id="labelFormulario">Telefone</label>
                <input style="border-color: #C0C0C0" type="text" class="form-control" name="telefone" required
                  value="{{old('telefone', $entidade->telefone)}}" maxlength="150">

              </div>
            </div>
            <input type="hidden" name="id" value="{{$entidade->id}}">
            <a href="{{route('cliente.list')}}" class="btn btn-primary"><i class="fa fa-reply"></i> Voltar</a>
            <button class="btn btn-success" onclick="$('#send').click(); "><i class="fa fa-save"></i> Salvar</button>
        </div>
        </form>
      </div>
    </div>
  </div>
@endsection