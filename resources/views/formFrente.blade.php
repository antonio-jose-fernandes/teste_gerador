<!DOCTYPE html>
<?php

use Carbon\Carbon;

?>
<html lang="en">
<head>
    <style>
        .intro-img {
            width: 30%;
            float: left;
        }

    </style>


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
        <div>

        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Hero Area Start -->
    <div id="hero-area">
        <div class="container">


            <div class="col-12" style="color: black">
                <div class="card" style="margin-top:15.3%">
                    <div class="card-header">
                        <h5 class="title">Criar cadastro</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('professor.saveFrente')}}">
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

                                <div class="col-md-3 px-8">
                                    <div class="form-group">
                                        <label id="labelFormulario">Siape</label>
                                        <input style="border-color: #C0C0C0" type="text" class="form-control"
                                               name="siape"
                                               required value="{{$entidade->siape}}" maxlength="150">

                                    </div>
                                </div>
                                <div class="col-md-3 px-8">
                                    <div class="form-group">
                                        <label id="labelFormulario">Departamento</label>
                                        <input style="border-color: #C0C0C0" type="text" class="form-control"
                                               name="departamento" required value="{{$entidade->departamento}}"
                                               maxlength="150">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 px-8">


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


                            </div>

                            <input type="hidden" name="id" value="{{$entidade->id}}">
                            <a href="{{route('welcome')}}" class="btn btn-primary"><i
                                    class="fa fa-reply"></i><span> Voltar</span></a>
                            <button class="btn btn-success" onclick="$('#send').click(); "><i
                                    class="fa fa-save"></i><span> Salvar</span>
                            </button>
                    </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    <!-- Hero Area End -->

</header>

<br><br>
<br>

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


