<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #a9f3d6, #0e9b59);
            height: 100vh;
        }

        .card {
            border: none;
            border-radius: 15px;
        }

        .card-body {
            padding: 2.5rem;
        }

        .form-control {
            border-radius: 10px;
            padding-left: 40px;
        }

        .input-group-text {
            background: transparent;
            border: none;
            position: absolute;
            z-index: 10;
            height: 100%;
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #6c757d;
        }

        .btn-success {
            border-radius: 10px;
            padding: 10px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-success:hover {
            transform: scale(1.03);
        }

        .logo {
            width: 300px;
            margin-bottom: 15px;
        }

    </style>

    @if(isset($msg))
        <script src="/assets/js/core/jquery.min.js"></script>
        <script>
            alert("Favor verificar usuário/senha");
        </script>
    @endif
</head>

<section class="d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
        <div class="card-body text-center">

            <!-- Logo opcional -->
          <img src="/assets/img/logo_ifce.png" class="logo">

            <h3 class="mb-4">Acesso ao Sistema</h3>

            <form method="post" action="{{route('logar')}}">
                @csrf

                <div class="mb-3 input-icon">
                    <i class="bi bi-person"></i>
                    <input type="text" class="form-control" placeholder="Usuário" name="username" required>
                </div>

                <div class="mb-4 input-icon">
                    <i class="bi bi-lock"></i>
                    <input type="password" class="form-control" placeholder="Senha" name="password" required>
                </div>

                <button class="btn btn-success w-100" type="submit">Entrar</button>
            </form>

        </div>
    </div>
</section>