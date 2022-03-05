<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/TipoCreditoController.php'; ?>


<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<h3 class="col-7">Tipos de Credito</h3>
		<a href="crearTipoCredito.php" class="btn btn-info col-5 col-sm-4 col-md-3	">Adicionar Tipo de Credito</a>
	</div>
	<br>
	<!-- Mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-dark" role="alert">
		  	<b>Tipo Credito eliminado correctamente</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo Credito no pudo ser eliminado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif ($mensaje==3) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Tipo Credito Creado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==4) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo Credito no pudo ser creado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>
	
	<!-- llamado del objeto -->
	<?php 
		$objTipoCredControl = new TipoCreditoControlador();
		$resultado = $objTipoCredControl->listarTipoCredito();
	?>

	<!-- lista de usuarios -->
	<?php if (count($resultado)==0) { ?>
		
		<div class="alert alert-warning" role="alert">
		  	<b>Tipo de Creditos no encontrados</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php }else{  $count = 1; ?>

			<table class="table table-hover">
				<thead>
					<th scope="col">N°</th>
					<th scope="col">Nombre Credito</th>
					<th scope="col">Pago Asociado</th>
					<th scope="col">Gracia</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</thead>
				<tbody>

		<?php foreach ($resultado as $key => $result) { ?>

				<tr class="table-info">
					<td><?php echo $count ?></td>
					<td><?php echo $result['nombre_credito']; ?></td>
					<td><?php echo $result['nombre_pago']; ?></td>
					<td>
						<?php 

						if ($result['ap_gracia']==1) {
							echo '<i class="fa fa-check-square" aria-hidden="true"></i>';
						} else{
							echo '<i class="fa fa-window-close-o" aria-hidden="true"></i>';
						}

						?>
					</td>
					<td><a href="editarTipoCredito.php?cod=<?php echo $result['id_tipo_cre']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a onclick="return confirm('Quiere eliminar tipo de credito?')" href="eliminarTipoCredito.php?cod=<?php echo $result['id_tipo_cre']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>

		<?php $count ++ ; } ?>			
			</tbody>
		</table>
	<?php } ?>	
</div>	

<?php include '../layouts/footer.php'; ?>