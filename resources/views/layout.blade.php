<!DOCTYPE html>
<html lang="pt">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <meta charset="utf-8" />

    <title>

    </title>

    <!-- Inclua os arquivos JavaScript do Bootstrap (opcional, necessário para funcionalidades como fechar o alerta) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para remover o alerta após um determinado tempo
        setTimeout(function () {
            var alerta = document.getElementById('meuAlerta');
            alerta.classList.remove('show'); // Remover a classe 'show'
            alerta.classList.add('fade'); // Adicionar a classe 'fade' para uma animação de desaparecimento suave
            setTimeout(function () {
                alerta.remove(); // Remover o elemento do DOM
            }, 1000); // Tempo de espera após a animação antes de remover o elemento do DOM
        }, 3000); // Tempo em milissegundos antes de remover o alerta (5 segundos neste exemplo)
    </script>
    <style>
        /* Estilos para o alerta flutuante */
        .alert-flutuante {
            position: fixed; /* Posição fixa na tela */
            top: 20px; /* Distância do topo */
            right: 20px; /* Distância da direita */
            z-index: 9999; /* Z-index alto para sobrepor outros elementos */
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-success">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Alterna navegação">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="#"></a>
        <ul class="navbar-nav mr-auto mt-2 mt-lg-1">
            
         <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-columns-gap"></i> Cadastros
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    
                 <a class="dropdown-item" href="{{route('area.list')}}" >   <i class="bi bi-layers-half"></i> Área de atuação</a>
                    <a class="dropdown-item" href="{{route('semestre.list')}}" >   <i class="bi bi-calendar-check"></i> Semestre </a>
                </div>
            </div>


            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-book-half"></i> Professor
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{route('professor.list')}}" >   <i class="bi bi-people-fill"></i> Lista de professores</a>
                </div>
            </div>



            <div class="dropdown">
                 <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-file-earmark-medical"></i>  Importar distribuição
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                 <a class="dropdown-item" href="{{route('import.formEnsino')}}" >   <i class="bi bi-file-earmark-post"></i>  Importar arquivos</a> 
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-file-earmark-medical"></i> Relatórios
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"  href="{{route('relatorio.formRelProfessores')}}">   <i class="bi bi-file-earmark-check"></i> Por professor</a>
                    <a class="dropdown-item"  href="{{route('relatorio.formRelArea')}}">   <i class="bi bi-file-earmark-check"  target="_blank"></i> Por área</a>
                    <a class="dropdown-item"  href="{{route('relatorio.formRelSemestre')}}">   <i class="bi bi-file-earmark-check"  target="_blank"></i> Por Semestre</a>
                </div>
            </div>

            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-wrench-adjustable"></i> Configurações
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"  href="{{route('import.formProfessores')}}">   <i class="bi bi-person-fill-gear"></i> Importar dados professores</a>
                </div>
            </div>



        </ul>
        <div class="row justify-content-end  ">
            <div class="col-md-12 dropdown-item">
                <a class="flex-sm-fill text-sm-right nav-link" style="font-size: 15px; color: #f1f1f1; " onmouseover="this.style.color='green'" onmouseout="this.style.color='#f1f1f1'"  href="{{route('logout')}}" onclick="return confirm('Deseja realmente sair?')"><i class="bi bi-x-square"></i> Sair</a>
            </div>
        </div>
    </div>
</nav>
<div>

</div>
<div class="container">
    <div class="row">
    <br>
    </div>
    <div class="row">
        @if(isset($msg))
            <div class="container mt-5">
                <!-- Alerta padrão exibido quando a página é carregada -->
                <div class="alert alert-{{$msg["tipo"]}} show alert-flutuante" id="meuAlerta" role="alert">
                    {{$msg["valor"]}}
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        @endif
        <div class="col">
            @yield('conteudo')
        </div>

    </div>

</div>





</body>

</html>
