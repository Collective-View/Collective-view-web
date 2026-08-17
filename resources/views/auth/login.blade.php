<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECOSUR — Iniciar sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="login-body">

<div class="login-wrap">
    <div class="login-card">

        <div class="login-brand">
            <img src="images/logo.png" class="logo">
            <div class="navbar-name">
                <span class="title">Collective view</span>
                <span class="sub">Panel de Administración</span>
            </div>
        </div>

        @if (session('status'))
            <div class="alert-success">
                <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('status') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                <ul style="margin:0;padding-left:16px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group" style="margin-bottom:14px;">
                <label for="email">Correo electrónico</label>
                <input id="email" type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required autofocus autocomplete="username"
                       placeholder="tucorreo@ecosur.mx">
            </div>

            <div class="form-group" style="margin-bottom:14px;">
                <label for="password">Contraseña</label>
                <input id="password" type="password" name="password" class="form-control"
                       required autocomplete="current-password"
                       placeholder="••••••••">
            </div>

            <div class="login-row">
                <label class="login-remember">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span>Recordarme</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="login-forgot" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif
            </div>

            <div class="form-actions" style="margin-top:22px;">
                <button type="submit" class="btn-primary" style="width:100%; justify-content:center;">
                    Iniciar sesión
                </button>
            </div>
        </form>

    </div>
</div>

<style>
    .login-body {
        margin: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #f8fbfd, #eef6f7);
        font-family: 'DM Sans', sans-serif;
    }

    .login-wrap {
        width: 100%;
        max-width: 400px;
        padding: 20px;
    }

    .login-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 40px 36px;
        box-shadow: 0 20px 55px rgba(0, 0, 0, 0.10);
    }

    .login-brand {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 32px;
    }

    .login-brand .navbar-name {
        display: flex;
        flex-direction: column;
    }

    .login-brand .title {
        font-family: 'DM Serif Display', serif;
        font-size: 1.15rem;
        color: var(--gray-800, #1f2937);
        line-height: 1.2;
    }

    .login-brand .sub {
        font-size: 0.78rem;
        color: var(--gray-400, #9ca3af);
    }

    .login-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 6px;
        font-size: 0.85rem;
    }

    .login-remember {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--gray-400, #6b7280);
        cursor: pointer;
    }

    .login-remember input {
        accent-color: var(--ecosur-teal, #14bf98);
    }

    .login-forgot {
        color: var(--gray-400, #6b7280);
        text-decoration: underline;
    }

    .login-forgot:hover {
        color: var(--gray-800, #1f2937);
    }

    .logo{
        width: 56px;
        height: auto;
        object-fit: contain;
    }

    @media (max-width: 480px) {
        .login-card { padding: 32px 24px; }
    }
</style>

</body>
</html>