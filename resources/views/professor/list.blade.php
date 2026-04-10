@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm"></div>
@endsection
@section('topo')
    <a class="navbar-brand" href="{{route('professor.new')}}"><h3>Novo professor</h3></a>
@endsection
@section('pesquisa')
    <form action="{{route('professor.search')}}" method="get" id="pesquisar">
        @csrf
        <div class="input-group no-border">
            <input type="text" class="form-control" placeholder="Pesquisar..." name="filtro" id="filtro"
                   @if(isset($filtro))
                       value="{{$filtro}}"
                @endif >
            <div class="input-group-append">
                <div class="input-group-text" onclick="document.getElementById('pesquisar').submit();">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                </div>
            </div>
        </div>
        @endsection
        @section('conteudo')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 24px;
}

.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: .3s;
  border-radius: 24px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 3px;
  bottom: 3px;
  background-color: white;
  transition: .3s;
  border-radius: 50%;
}

input:checked + .slider {
  background-color: #28a745; /* verde */
}

input:checked + .slider:before {
  transform: translateX(20px);
}
</style>

       

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista de professor </h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <th> Nome</th>
                                    <th> Área de atuação</th>
                                     <th> SubÁrea de atuação</th>
                                     <th>Possui Cargo</th>
                                    <th></th>
                                    </thead>
                                    <tbody>
                                    @if(sizeof($lista)>0)
                                        @foreach($lista as $ent)
                                            <tr>
                                                <td>{{$ent->nome}}</td>
                                                <td><select class="form-control select-area {{ $ent->area_id == null ? 'is-invalid' : '' }}" data-id="{{ $ent->id }}" disabled>
                                                     @if($ent->area_id == "") 
                                                            <option value=""
                                                                selected >
                                                                Não definido
                                                            </option> 
                                                     @endif
                                                    @foreach($areas as $area)                                                       
                                                        <option value="{{ $area->id }}"
                                                            @if($ent->area_id == $area->id) selected @endif>
                                                            {{ $area->nome }}
                                                        </option>                                                      
                                                    @endforeach
                                                </select></td>


                                                 <td><select class="form-control select-subarea {{ $ent->subarea_id == null ? 'is-invalid' : '' }}" data-id="{{ $ent->id }}" >
                                                     @if($ent->subarea_id == "") 
                                                            <option value=""
                                                                selected >
                                                                Não definido
                                                            </option> 
                                                     @endif
                                                    @foreach($subareas->where('area_id', $ent->area_id) as $subarea)                                                       
                                                        <option value="{{ $subarea->id }}"
                                                            @if($ent->subarea_id == $subarea->id) selected @endif>
                                                            {{ $subarea->nome }}
                                                        </option>                                                      
                                                    @endforeach
                                                </select></td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" 
                                                            class="check-cargo" 
                                                            data-id="{{ $ent->id }}"
                                                            {{ $ent->possui_cargo ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>     
                                                     <a rel="tooltip" title="Editar"
                                                        class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral"
                                                        data-original-title="Edit"
                                                        href="{{route('professor.edit',$ent->id)}}">
                                                        <ion-icon name="create-outline"></ion-icon>
                                                    </a>                                           
                                                    <a href="{{route('professor.delete',$ent->id)}}"
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
                        </div>
                    </div>
                </div>
            </div>

             <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <script>


                $(document).on('change', '.check-cargo', function () {
                    let professor_id = $(this).data('id');
                    let possui_cargo = $(this).is(':checked') ? 1 : 0;

                    $.ajax({
                        url: "{{ route('professor.updateCargo') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: professor_id,
                            possui_cargo: possui_cargo
                        },
                        success: function (response) {
                            if (response.success) {
                                console.log("Cargo atualizado com sucesso");
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                            alert("Erro ao atualizar cargo");
                        }
                    });
                });

   
            $(document).ready(function () {

               $(document).on('change', '.select-subarea', function () {
                    let subarea_id = $(this).val();
                    let professor_id = $(this).data('id');
                   
                    $.ajax({
                        url: "{{ route('professor.updateSubArea') }}",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: professor_id,
                            subarea_id: subarea_id
                        },
                        success: function (response) {
                            if (response.success) {
                                console.log("Atualizado com sucesso");
                            }
                        },
                        error: function () {
                            alert("Erro ao atualizar");
                        }
                    });
                });
            });

            $(document).on('change', '.select-subarea', function () {

                let valor = $(this).val();

                if (valor === "") {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }

            });


            
            </script>
@endsection
