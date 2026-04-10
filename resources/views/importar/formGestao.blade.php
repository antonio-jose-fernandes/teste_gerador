@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
    <script>
        function validarFormulario() {
            var arquivo = document.getElementById("planilha");
            if (arquivo.files.length === 0) {
                alert("Por favor, selecione um arquivo.");
                return false;
            }
            return true;
        }
    </script>
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Importar planilha de dados da <b style="color: #1e7e34;font-size: 35px">GESTÃO</b></h5>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <!-- Formulário -->
                                <form action="{{route('semestre.gestao_import')}}"  method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="inputCampo" class="col-sm-3 col-form-label">Importar Planilha:</label>
                                        <div class="col-sm-5">
                                            <input type="file" id="planilha" name="planilha" accept=".xlsx, .xls">
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-success" type="submit">Importar Planilha</button>
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
