<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/UsuarioController.php'; ?>
<div class="container">
	<br>
	<center><h3>Editar Usuario</h3></center>

	<!-- mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Usuario Editado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Usuario no pudo ser editado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>

	<!-- cuerpo de formulario -->
	<?php 
		$id = @$_REQUEST['cod'];
		
		if ($id == 0 || $id==null || $id='') { ?>

		<div class="alert alert-warning" role="alert">
		  	<b>Error al buscar Usuario</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php 

		}else{
		$id = $_REQUEST['cod'];
		$objUsuContro = new UsuarioControlador();
		$resultado = $objUsuContro->seleccionarUsuario($id);

			foreach ($resultado as $key => $resul) {
				// print_r($resul);
	?>

		<form action="modificarUsuario.php" method="post" class="editUser">
			
			<input type="hidden" class="form-control" name="id_usu" value="<?php echo $resul['id_usu']; ?>">

			<div class="form-group">
		      <label for="exampleInputPassword1">Alias</label>
		      <input type="text" class="form-control" name="alias" value="<?php echo $resul['alias']; ?>" required="" >
		    </div>

		    <div class="form-group">
		      <label for="exampleInputPassword1">Usuario</label>
		      <input type="text" class="form-control" name="usuario" value="<?php echo $resul['usuario']; ?>" required="" >
		    </div>			
			
			<div class="form-group">
		      <label for="exampleInputPassword1">Contrasena</label>
		      <input type="password" class="form-control" name="contrasena" value="<?php echo $resul['contrasena']; ?>" required="" >
		    </div>

		    <div class="form-group">
		      <label for="exampleInputPassword1">Confirmar Contrasena</label>
		      <input type="password" class="form-control" name="confircontrasena" value="<?php echo $resul['contrasena']; ?>" required="" >
		    </div>

			<div class="form-group">
		    	<a href="listaUsuarios.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="editar">
			</div>
		</form>

	<?php 

			} 
		}

	?>

</div>	
<?php include '../layouts/footer.php'; ?>

