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
                    <h5 class="title">  <b style="color: #2a5788;font-size: 35px">Importar planilhas de dados</b></h5>
                </div>
                <div class="card-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Formulário -->
                                <form action="{{route('semestre.ensino_import')}}"  method="POST" enctype="multipart/form-data" onsubmit="return validarFormulario()">
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
                                        <label for="inputCampo" class="col-sm-3 col-form-label">Importar Planilhas:</label>
                                        <div class="col-sm-5">
                                            <input type="file" id="planilha" name="planilhas[]" accept=".xlsx, .xls" multiple>
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-success" type="submit">Importar Planilha</button>
                                        </div>
                                    </div>

                                    <div style="background-color: #fff3cd; padding: 10px; border: 1px solid #ffeeba; border-radius: 5px;">
                                        <strong>Observações:</strong>
                                        <ul style="margin: 5px 0 0 15px;">
                                            <li><strong>Aba:</strong> Nome do Curso</li>
                                            <li><strong>Coluna C:</strong> Eixo</li>
                                            <li><strong>Coluna E:</strong> Disciplinas</li>
                                            <li><strong>Coluna F:</strong> Carga Horária</li>
                                            <li><strong>Coluna J:</strong> Professor</li>
                                        </ul>
                                        <br>
                                        <p>A importação da distribuição das disciplinas deve ser realizada de uma única vez, 
                                            sendo necessário inserir todas as planilhas correspondentes a cada semestre simultaneamente.
                                             Ressalta-se que, ao realizar uma nova importação para um determinado semestre, 
                                            todos os registros anteriores vinculados a esse semestre serão automaticamente excluídos. </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
