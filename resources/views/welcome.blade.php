<!DOCTYPE html>
<?php

use Carbon\Carbon;

?>
<html lang="pt">
<head>
    <style>
        .intro-img {
            width: 30%;
            float: left;
        }


    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Gerador PIT - Campus Sobral</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assetsl/css/bootstrap.min.css">
    <!-- Icon -->
    <link rel="stylesheet" href="../assetsl/fonts/line-icons.css">
    <!-- Slicknav -->
    <link rel="stylesheet" href="../assetsl/css/slicknav.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="../assetsl/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assetsl/css/owl.theme.css">

    <link rel="stylesheet" href="../assetsl/css/magnific-popup.css">
    <link rel="stylesheet" href="../assetsl/css/nivo-lightbox.css">
    <!-- Animate -->
    <link rel="stylesheet" href="../assetsl/css/animate.css">
    <!-- Main Style -->
    <link rel="stylesheet" href="../assetsl/css/main.css">
    <!-- Responsive Style -->
    <link rel="stylesheet" href="../assetsl/css/responsive.css">

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
        }, 6000); // Tempo em milissegundos antes de remover o alerta (5 segundos neste exemplo)
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
    <style>
        /* Estilos para o corpo e html */
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        /* Estilos para o rodapé */
        footer {
            background-color: #00420C;
            color: #fff;
            padding: 15px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>

</head>
<body>
@if(isset($msg))
    <div class="container mt-5">
        <!-- Alerta padrão exibido quando a página é carregada -->
        <div class="alert alert-{{$msg["tipo"]}} show alert-flutuante" id="meuAlerta" role="alert">
           {{$msg["valor"]}}
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endif

<!-- Header Area wrapper Starts -->
<header id="header-wrap">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md fixed-top" style="background-color: #1e7e34">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->


            <div class='intro-img'
                 style='background-color: #157E27; border-radius: 65px; -moz-border-radius: 65px; -webkit-border-radius: 15px; border: 0px solid #000; padding: 20px; opacity: 0.9; -moz-opacity:0.9; -webkit-opacity:0.9; '
                 style='cursor: pointer;'>
                <a href='https://ifce.edu.br/sobral' target='_blank'> <img
                        src='https://sistemas.sobral.ifce.edu.br//img/logo_instituto.png' alt='some text'
                        class='img-fluid' style='cursor: pointer;'></a>
            </div>

            <div class='container'>
                <a href="#hero-area" class="scrollto"><h5><font style='color:white; font-weight: normal;'>Gerador
                            PIT</font></h5></a>

            </div>
        </div>
       
    </nav>
    <!-- Navbar End -->

    <!-- Hero Area Start -->
    <div id="hero-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contents" style="padding-top:15.3%">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <form action="{{route('relatorio.pitprofessor')}}" target="_blank" method="POST">
                                        @csrf
                                        <div class="form">
                                            <label for="username" style="color: black">SIAPE:</label>
                                            <input type="text" style="border-color: #1e7e34" name="siape"
                                                   class="form-control" required>

                                        </div>
                                         <div class="form">
                                            <label for="username" style="color: black">NOME COMPLETO:</label>
                                            <input type="text" style="border-color: #1e7e34" name="nome"
                                                   class="form-control" required>

                                        </div>
                                         <label  for="username" style="color: black"> Semestre:</label>
                                        <select name="semestre_id" class="form-control"  style="border-color: #1e7e34" required>
                                            <option value="">Selecione um semestre</option>
                                            @foreach($semestres as $semestre)
                                                <option value="{{ $semestre->id }}">
                                                    {{ $semestre->descricao }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <hr class="my-4">
                                        <div class="header-button wow fadeInUp  text-center" data-wow-delay="0.3s">
                                            <button type="submit" class="btn btn-success">Gerar PDF</button>

                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Hero Area End -->

</header>

<br><br>

<!-- Copyright Section Start -->

<footer>

<div style="background-color: #00420C;">
    <div class="container">
        <div class="row" style="font-size: 13px">
            <div class="col-lg-6 col-md-3 col-xs-12">
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12">
                <div class="text-center" style="color: #f1f1f1;">
                    <div>
                        <a href="{{route('login')}}" style="color: #f1f1f1;">DIREN - IFCE Campus Sobral </a>
                        <br>Coordenação de Tecnologia da Informação - CTI
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</footer>

<!-- Copyright Section End -->

<!-- Go to Top Link -->
<a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
</a>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="assetsl/js/jquery-min.js"></script>
<script src="assetsl/js/popper.min.js"></script>
<script src="assetsl/js/bootstrap.min.js"></script>
<script src="assetsl/js/owl.carousel.min.js"></script>
<script src="assetsl/js/wow.js"></script>
<script src="assetsl/js/jquery.nav.js"></script>
<script src="assetsl/js/scrolling-nav.js"></script>
<script src="assetsl/js/jquery.easing.min.js"></script>
<script src="assetsl/js/jquery.counterup.min.js"></script>
<script src="assetsl/js/waypoints.min.js"></script>
<script src="assetsl/js/jquery.slicknav.js"></script>
<script src="assetsl/js/main.js"></script>

</body>
</html>
