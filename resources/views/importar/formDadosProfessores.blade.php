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
                    <h5 class="title">  <b style="color: #2a5788;font-size: 35px">Importar planilhas de dados dos Professores</b></h5>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Formulário -->
                                <form action="{{route('semestre.dados_professor_import')}}"  method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
                                    @csrf                                   
                                    <div class="form-group row">
                                        <label for="inputCampo" class="col- sm-3 col-form-label">Importar Planilhas:</label>
                                        <div class="col-sm-5">
                                             <input type="file" id="planilha" name="planilha" accept=".xlsx, .xls">
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-success" type="submit">Importar Planilha</button>
                                        </div>
                                    </div>
                                    <div style="background-color: #fff3cd; padding: 10px; border: 1px solid #ffeeba; border-radius: 5px;">
                                        <strong>Observações:</strong>
                                        <ul style="margin: 5px 0 0 15px;">
                                            <li><strong>Coluna B:</strong> Matrícula</li>
                                            <li><strong>Coluna C:</strong> Área</li>
                                            <li><strong>Coluna D:</strong> Nome</li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
