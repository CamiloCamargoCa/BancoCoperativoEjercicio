  <!-- Navigation -->
 
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <img src="../../images/opengraph-image.png" alt="" style="width:8%;">
  <a class="navbar-brand" href="../sesion/index.php"><?php echo '<b>'.@$_SESSION['usuario']['alias'].'</b>';   ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <?php if (!isset($_SESSION['usuario'])) { ?>
        <li class="nav-item">
          <a class="nav-link" id="inisesion" data-toggle="modal" data-target="#exampleModalCenter" href="login.php">Ingresar</a>
        </li>
      <?php }else{ ?>
        <li class="nav-item">
          <a class="nav-link" href="../sesion/index.php">Credito</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../tipo_credito/listarTipoCreditos.php">Tipo de Credito</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../pago/listarPagos.php">Tipo de Pagos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../plazo/listarPlazos.php">PLazos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../amortizaciones/listarAmortizaciones.php">Amortizaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../usuario/listaUsuarios.php">Usuarios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../sesion/CerrarSesion.php">Cerrar Sesion</a>
        </li>
      <?php } ?>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button> -->

    </form>
  </div>
</nav>
