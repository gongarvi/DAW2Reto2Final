<!doctype html>
<html lang="es" style="height: 100%">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link class="logo" rel="icon" type="image/vnd.microsoft.icon" href="..\image/logo.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Desayunos Femenistas</title>

    @include("partials.include")

    @yield("head-extras")

</head>
<body style="height: 100%">
    <header>

    </header>
    <nav>
        @include("partials.menu")
    </nav>
    <main style="width:100%; height: 100%;">
        @yield("content")
    </main>
    <footer>
        
    </footer>
</body>
</html>
