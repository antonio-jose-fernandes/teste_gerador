@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
  <div class="row">

     <div class="col-md-10">
         <div class="card">
            <div class="card-header">
                <h5 class="title">Editar</h5>
            </div>
            <div class="card-body">
<form  method="post" action="{{route('cliente.save')}}" >
  @csrf

    <div class="col-md-12 px-8">
     <div class="form-group">
       <label id="labelFormulario">Nome</label>
       <input style="border-color: #C0C0C0" type="text" class="form-control" name="nome" required
           value="{{old('nome',$entidade->nome)}}" maxlength="150">

  </div>
 </div>
    <div class="col-md-12 px-8">
     <div class="form-group">
       <label id="labelFormulario">Tipo</label>
       <input style="border-color: #C0C0C0" type="text" class="form-control" name="tipo" required
           value="{{old('tipo',$entidade->tipo)}}" maxlength="150">

  </div>
 </div>
    <input type="hidden" name ="id" value="{{$entidade->id}}">
    <a href="{{route('cliente.list')}}" class="btn btn-primary"><i class="fa fa-reply"></i> Voltar</a>
    <button class="btn btn-success" onclick="$('#send').click(); "><i class="fa fa-save"></i> Salvar</button>
  </div>
</form>
           </div>
            </div>
     </div>
@endsection
