<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/UsuarioController.php'; ?>

<div class="container">
	<br>
	<center><h3>Crear Usuario</h3></center>

		<form action="crearUsuario.php" method="post">

			<div class="form-group">
		      <label for="exampleInputPassword1">Alias</label>
		      <input type="text" class="form-control" name="alias" required="" >
		    </div>

		    <div class="form-group">
		      <label for="exampleInputPassword1">Usuario</label>
		      <input type="text" class="form-control" name="usuario" required="" >
		    </div>			
			
			<div class="form-group">
		      <label for="exampleInputPassword1">Contrasena</label>
		      <input type="password" class="form-control" name="contrasena" required="" >
		    </div>

		    <div class="form-group">
		      <label for="exampleInputPassword1">Confirmar Contrasena</label>
		      <input type="password" class="form-control" name="confircontrasena" required="" >
		    </div>

			<div class="form-group">
		    	<a href="listaUsuarios.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="Crear">
			</div>
		</form>


<?php 	 


if (isset($_POST['alias']) && !empty($_POST['alias']) &&
	isset($_POST['usuario']) && !empty($_POST['usuario']) &&
	isset($_POST['confircontrasena']) && !empty($_POST['confircontrasena']) &&
	isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {

	$alias = $_POST['alias'];
	$usuario = $_POST['usuario'];
	$confircontrasena = $_POST['confircontrasena'];
	$contrasena = $_POST['contrasena'];

	$objUsuContro = new UsuarioControlador();
	$resultado = $objUsuContro->crearUsuario($alias,$usuario,$contrasena);

	if ($resultado==true) {
		echo '
			
		<script type="text/javascript">
          location.href="listaUsuarios.php?men=3";
		</script>
		';

	}else{
		echo'
		<script type="text/javascript">
          location.href="listaUsuarios.php?men=4";
		</script>

		';
	}
}

?>

</div>	
<?php include '../layouts/footer.php'; ?>
