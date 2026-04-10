@extends('layout')
@section('head')
    <div class="panel-header panel-header-sm">

    </div>

@endsection
@section('topo')
    <a class="navbar-brand" href="{{route('usuario.list')}}">@lang('menu.voltar')</a>
@endsection
@section('conteudo')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">Usuário</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('usuario.create')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Nome para login</label>
                                    <input type="text" class="form-control" name="username" required
                                           value="{{old('username')}}" maxlength="15">
                                    @error('username')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" class="form-control" name="password" required
                                           value="{{old('password')}}" maxlength="15">
                                    @error('password')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" name="email" required
                                           value="{{old('email')}}">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Primeiro nome</label>
                                    <input type="text" class="form-control" value="{{old('firstname')}}"
                                           name="firstname" required maxlength="150">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Último nome</label>
                                    <input type="text" class="form-control" value="{{old('lastname')}}" name="lastname"
                                           required maxlength="150">
                                </div>
                            </div>




                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>@lang('cadastros.telefone')</label>
                                    <input type="tel" value="{{old('phone')}}"
                                           name="telefone" class="form-control"
                                           pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$"
                                           onkeypress="mask(this, mphone);"
                                           onblur="mask(this, mphone);" required>
                                </div>
                            </div>
                        </div>

                            <input type="hidden" name="id" value="{{$usuario->id}}">
                            <div class="form-inline">
                                <div class="title_right noprint">
                                    <br>
                                    <a href="{{route('usuario.list')}}" class="btn btn-primary"><i
                                            class="bi bi-skip-backward-fill"></i><span>&nbsp;&nbsp;Voltar</span></a>
                                    <button class="btn btn-success" onclick="$('#send').click(); "><i
                                            class="bi bi-sd-card-fill"></i><span>&nbsp;&nbsp;@lang('menu.btnsave')</span>
                                    </button>
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
