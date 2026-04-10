@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
@if(session('msg'))
    <div class="alert alert-{{ session('msg.tipo') }}">
        {{ session('msg.valor') }}
    </div>
@endif
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Semestre</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('semestre.save')}}">
                        @csrf

                        <div class="col-md-12 px-12">
                            <div class="form-group">
                                <label id="labelFormulario">Descrição do semestre</label>
                                <input style="border-color: #C0C0C0" type="text" class="form-control" name="descricao"
                                       required value="{{old('descricao', $entidade->descricao ?? '')}}" maxlength="10">

                            </div>
                        </div>
                            <input type="hidden" name="id" value="{{$entidade->id}}">
                              <a href="{{route('semestre.list')}}" class="btn btn-primary"><i class="fa fa-reply"></i><span> Voltar</span></a>

                            <button class="btn btn-success" onclick="$('#send').click(); "><i
                                    class="fa fa-save"></i><span> Salvar</span></button>

                    </form>

                </div>
            </div>
        </div>
@endsection
