<!DOCTYPE html>
<html lang="es">

  <head>
  <?php session_start(); 

  //Validar si se está ingresando con sesión correctamente
  if (!$_SESSION) {
      echo '<script language = javascript>
        alert("usuario no autenticado")
        self.location = "../sesion/index.php"
      </script>';
  }

  ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Banco Coperativo Industrial</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="../../plugins/bootstrap-4.3.1-dist/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../../plugins/font-awesome-4.7.0/css/font-awesome.min.css">
    

  </head>

  <body>