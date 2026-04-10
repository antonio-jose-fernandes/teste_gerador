@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
   
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">  <b style="color: #2a5788;font-size: 35px">Relatório por Área</b></h5>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Formulário -->
                                <form action="{{route('relatorio.distribuicaoarea')}}"  method="POST" enctype="multipart/form-data"  target="_blank">
                                    @csrf
                                    <label> Semestre:</label>
                                    <select name="semestre_id" class="form-control" required>
                                        <option value="">Selecione um semestre</option>
                                        @foreach($semestres as $semestre)
                                            <option value="{{ $semestre->id }}">
                                                {{ $semestre->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <div class="form-group row">                                       
                                        <div class="col-sm-3">
                                            <button class="btn btn-success" type="submit">Gerar Relatório</button>
                                        </div>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
