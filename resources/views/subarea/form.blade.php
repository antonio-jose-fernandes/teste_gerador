@extends('layout')
@section('head')
  <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
  <div class="row">

     <div class="col-md-12">
         <div class="card">
            <div class="card-header">
                <h5 class="title">SubÁrea de atuação</h5>
            </div>
            <div class="card-body">
<form  method="post" action="{{route('subarea.save',$area->id)}}" >
  @csrf

    <div class="col-md-10 px-8">
     <div class="form-group">
       <label id="labelFormulario">Nome</label>
       <input style="border-color: #C0C0C0" type="text" class="form-control" name="nome" required value="{{$entidade->nome}}" maxlength="150">

  </div>
 </div>
    <input type="hidden" name ="id" value="{{$entidade->id}}">
    <a href="{{route('subarea.list',$area->id)}}" class="btn btn-primary"><i class="fa fa-reply"></i><span> Voltar</span></a>
    <button class="btn btn-success" onclick="$('#send').click(); "><i class="fa fa-save"></i><span> Salvar</span></button>
  </div>
</form>
           </div>
            </div>
     </div>
@endsection
