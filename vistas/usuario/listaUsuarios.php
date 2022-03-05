<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/UsuarioController.php'; ?>


<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<h3 class="col-8">Lista de Usuarios</h3>
		<a href="crearUsuario.php" class="btn btn-info col-4 col-sm-3 col-md-2	">Crear Usuario</a>
	</div>
	<br>
	<!-- Mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-dark" role="alert">
		  	<b>Usuario eliminado correctamente</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Usuario no pudo ser eliminado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif ($mensaje==3) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Usuario Creado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==4) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Usuario no pudo ser creado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>
	
	<!-- llamado del objeto -->
	<?php 
		$objUsuContro = new UsuarioControlador();
		$resultado = $objUsuContro->listarUsuario();
	?>

	<!-- lista de usuarios -->
	<?php if (count($resultado)==0) { ?>
		
		<div class="alert alert-warning" role="alert">
		  	<b>Registros de usuario no encontrados</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php }else{  $count = 1; ?>

			<table class="table table-hover">
				<thead>
					<th scope="col">N°</th>
					<th scope="col">Alias</th>
					<th scope="col">Usuario</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</thead>
				<tbody>

		<?php foreach ($resultado as $key => $result) { ?>

				<tr class="table-info">
					<td><?php echo $count ?></td>
					<td><?php echo $result['alias']; ?></td>
					<td><?php echo $result['usuario']; ?></td>
					<td><a href="editarUsuario.php?cod=<?php echo $result['id_usu']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a onclick="return confirm('Quiere eliminar usuario?')" href="eliminarUsuario.php?cod=<?php echo $result['id_usu']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>

		<?php $count ++ ; } ?>			
			</tbody>
		</table>
	<?php } ?>	
</div>	

<?php include '../layouts/footer.php'; ?>