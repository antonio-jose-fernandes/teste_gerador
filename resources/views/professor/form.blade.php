@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm"></div>
@endsection
@section('conteudo')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Editar Professor</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('professor.save')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 px-8">
                                <div class="form-group">
                                    <label id="labelFormulario">Nome</label>
                                    <input style="border-color: #C0C0C0" type="text" class="form-control"
                                           name="nome"
                                           required value="{{$entidade->nome}}" maxlength="150">
                                </div>
                            </div>

                            <div class="col-md-6 px-8">
                                <div class="form-group">
                                    <label id="labelFormulario">Siape</label>
                                    <input style="border-color: #C0C0C0" type="text" class="form-control"
                                           name="siape"
                                           required value="{{$entidade->siape}}" maxlength="150">

                                </div>
                            </div>                             
                           
                        </div>
                        <div class="row">
                             <div class="col-md-3 px-8">
                                <div class="form-group">
                                    <label id="labelFormulario">Departamento</label>
                                    <input style="border-color: #C0C0C0" type="text" class="form-control"
                                           name="departamento" required value="{{$entidade->departamento}}"
                                           maxlength="150">

                                </div>
                            </div>

                            <div class="col-md-3 px-8">


                                <label id="labelFormulario">Tipo vínculo</label>
                                <select style="border-color: #C0C0C0" class="form-control" id="tipo_vinculo"
                                        name="tipo_vinculo" required>
                                    <option value="EFETIVO"
                                            @if($entidade->tipo_vinculo == "EFETIVO") selected @endif>EFETIVO
                                    </option>
                                    <option value="SUBSTITUTO"
                                            @if($entidade->tipo_vinculo == "SUBSTITUTO") selected @endif>SUBSTITUTO
                                    </option>
                                    <option value="TEMPORÁRIO OU COLABORAÇÃO TÉCNICA"
                                            @if($entidade->tipo_vinculo == "TEMPORÁRIO OU COLABORAÇÃO TÉCNICA") selected @endif>
                                        TEMPORÁRIO OU COLABORAÇÃO TÉCNICA
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-6 px-8">
                                <div class="form-group">
                                    <label id="labelFormulario">Regime de trabalho</label>
                                    <select style="border-color: #C0C0C0" class="form-control" id="regime_trabalho"
                                            name="regime_trabalho" required>
                                        <option value="40h D.E."
                                                @if($entidade->regime_trabalho == "40h D.E.") selected @endif>40h
                                            D.E.
                                        </option>
                                        <option value="40h"
                                                @if($entidade->regime_trabalho == "40h") selected @endif>40h
                                        </option>
                                        <option value="20h"
                                                @if($entidade->regime_trabalho == "20h") selected @endif>20h
                                        </option>
                                    </select>
                                </div>
                            </div>

                                <div class="col-md-6">
                                    <label>Área</label>
                                    <select id="area_id" name="area_id" class="form-control" required>
                                        <option value="">Selecione a área</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->id }}"
                                                {{ old('area_id', $entidade->area_id) == $area->id ? 'selected' : '' }}>
                                                {{ $area->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label>Subárea</label>
                                    <select id="subarea_id" name="subarea_id" class="form-control" required>
                                        <option value="">Selecione a subárea</option>
                                    </select>
                                </div>
                                </div>
                            <br> 



                        <input type="hidden" name="id" value="{{$entidade->id}}">
                        <a href="{{route('professor.list')}}" class="btn btn-primary"><i class="fa fa-reply"></i><span> Voltar</span></a>
                        <button class="btn btn-success" onclick="$('#send').click(); "><i class="fa fa-save"></i><span> Salvar</span>
                        </button>
                </div>
                </form>
            </div>
        </div>
    </div>

  <script>
document.addEventListener('DOMContentLoaded', function () {
    const subareas = @json($subareas);
    const areaSelect = document.getElementById('area_id');
    const subareaSelect = document.getElementById('subarea_id');

    const subareaProfessor = "{{ old('subarea_id', $entidade->subarea_id) }}".trim();

   
    function carregarSubareas(areaId, subSelecionada = '') {
        subareaSelect.innerHTML = '<option value="">Selecione a subárea</option>';
        let filtradas = subareas.filter(sub => String(sub.area_id) === String(areaId));

        filtradas.forEach(sub => {
            let option = document.createElement('option');
            option.value = sub.id;
            option.text = sub.nome;

            // comparação segura
            if (String(sub.id) === String(subSelecionada)) {
                option.selected = true;
            }

            subareaSelect.appendChild(option);
        });
    }

    // abre a edição já selecionando
    if (areaSelect.value) {
        carregarSubareas(areaSelect.value, subareaProfessor);
    }

    areaSelect.addEventListener('change', function () {
        carregarSubareas(this.value);
    });
});
</script>
@endsection
