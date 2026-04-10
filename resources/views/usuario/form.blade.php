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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">@lang('cadastros.edit')</h5>
                </div>
                <div class="card-body">
                    <form  method="post" action="{{route('usuario.salvar')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" name="username" required value="{{$usuario->username}}">
                                    @error('nome')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-9 px-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control"  name="email" required value="{{$usuario->email}}">
                                    @error('email')
                                    {{$message}}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>Primeiro nome</label>
                                    <input type="text" class="form-control"  value="{{$usuario->name}}" name="firstname" required>
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="form-group">
                                    <label>Último nome</label>
                                    <input type="text" class="form-control" value="{{$usuario->lastname}}" name="lastname" required>
                                </div>
                            </div>
                        </div>

                           <div class="row">
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="tel" value="{{$usuario->phone}}" name="phone" class="form-control" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                                </div>
                            </div>

                            @if(Auth::user()->type==1)
                                @if(isset($types))

                                    <div class="col-md-4 pl-1">
                                        <div class="form-group">
                                            <label>@lang('cadastros.type')</label>
                                            <select name="typeuser" class="form-control" >
                                                @foreach($types as $lin)
                                                    <option value="{{$lin->id}}"
                                                            @if($usuario->type == $lin->id)
                                                                selected
                                                        @endif
                                                    > {{$lin->type}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @else
                                    <input type="hidden" name="typeuser" value="{{$usuario->type}}"/>
                                @endif
                            @endif

                        </div>


                        <input type="hidden" name ="id" value="{{$usuario->id}}">
                        <div class="title_right noprint">
                            <a href="{{route('usuario.list')}}" class="btn btn-primary"><i class="bi bi-skip-backward-fill"></i><span>&nbsp;&nbsp;@lang('menu.btnback')</span></a>
                            <button class="btn btn-success" onclick="$('#send').click(); "><i class="bi bi-sd-card-fill"></i><span>&nbsp;&nbsp;@lang('menu.btnsave')</span></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        @if(isset($usuario))
            @if($usuario->id)
                <div class="col-md-4">
            <div class="card card-user">

                <div class="card-body">
                    <div class="author">
                        @if($usuario->avatar)
                            <img class="avatar border-gray" src="{{$usuario->avatar}}" alt="...">
                        @else
                            <img class="avatar border-gray" src="/assets/img/default-avatar.png" alt="...">
                        @endif
                            <h5 class="title">{{$usuario->name}} {{$usuario->lastname}}</h5>

                        <p class="description">
                            {{$usuario->username}}
                        </p>
                    </div>
                    <p class="description text-center">

                    </p>
                </div>
                <hr>
                <div class="button-container">
                    <button class="btn btn-neutral btn-icon btn-round btn-lg">
                        <a href="https://api.whatsapp.com/send?phone=55{{\App\Helper::removeMascFone($usuario->phone)}}&text=Ol%c3%a1">
                        <i class="fab fa-whatsapp"></i>
                        </a>
                    </button>

                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <a href="mailto:{{$usuario->email}}">
                            <i class="fab fa-google"></i>
                        </a>
                    </button>
                </div>
            </div>
        </div>
            @endif
        @endif
    </div>
@endsection
