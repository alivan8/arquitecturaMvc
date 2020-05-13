
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PatagoniaIT - Iniciar Seci&oacute;n</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="accion/verificarlogin.php" method="POST">
    <a href="principal.php"><svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg></a>
    <h1 class="h3 mb-3 font-weight-normal">¡Hola! Ingres&aacute; tu usuario y contrase&ntilde;a</h1>
    <label for="usnombre" class="sr-only">Usuario</label>
    <input type="text" id="usnombre" name="usnombre" class="form-control" placeholder="Usuario" required autofocus>
    <label for="uspass" class="sr-only">Contrase&ntilde;a</label>
    <input type="password" id="uspass" name="uspass" class="form-control" placeholder="Contrase&ntilde;a" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" name="remember" value="1"> Recuerdame
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>