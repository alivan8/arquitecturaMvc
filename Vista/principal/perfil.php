<?php
include_once '../../configuracion.php';
$session=new Session();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Patagonia IT - Actualizacion de datos</title>

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.1/examples/checkout/form-validation.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="py-5 text-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        <h2>Checkout form</h2>
    </div>
<div class="container h-100" style="width: 400px">
            <h4 class="mb-3">Datos de la cuenta</h4>

            <form class="form-signin" action="accion/actualizardatosperfil.php" method="POST">

                <input id="idusuario" name="idusuario" value="<?php  echo $session->getUsuario()->getIdusuario();  ?>" style="visibility:hidden">

                <br>DATOS PERSONALES<br>
                <label for="username" class="username">Usuario</label>
                <input type="text" id="username" name="usnombre" class="form-control" placeholder="Usuario" value="<?php  echo $session->getUsuario()->getUsnombre();  ?>" required autofocus>

                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="usmail" placeholder="miemail@ejemplo.com" value="<?php  echo $session->getUsuario()->getUsmail();  ?>" required autofocus>
                <br>CONTRASE&Ntilde;A<br>
                <label for="password" class="password">Contrase&ntilde;a nueva</label>
                <input type="password" id="password1" name="uspass1" class="form-control" placeholder="Contrase&ntilde;a nueva"  required>

                <label for="password" class="password">Repita la contrase&ntilde;a nueva</label>
                <input type="password" id="password" name="uspass" class="form-control" placeholder="Repita contrase&ntilde;a nueva"  required>


                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Actualizar datos</button>
            </form>

    <hr class="mb-4">
    <a class="btn btn-primary btn-lg btn-block" href="principal.php">No hacer cambios y volver</a>
</div>
    <script type="application/javascript">
        var password, password2;

        password = document.getElementById('password1');
        password2 = document.getElementById('password');

        password.onchange = password2.onkeyup = passwordMatch;

        function passwordMatch() {
            if(password.value !== password2.value)
                password2.setCustomValidity('Las contraseñas no coinciden.');

        else
                password2.setCustomValidity('');
        }

    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</body>
</html>