<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PlazoController.php'; ?>


<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<h3 class="col-8">Plazos</h3>
		<a href="crearPlazo.php" class="btn btn-info col-4 col-sm-3 col-md-2	">Adicionar Plazo</a>
	</div>
	<br>
	<!-- Mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-dark" role="alert">
		  	<b>Plazo eliminado correctamente</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Plazo no pudo ser eliminado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif ($mensaje==3) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Plazo Creado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==4) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Plazo no pudo ser creado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>
	
	<!-- llamado del objeto -->
	<?php 
		$objPlazo = new PlazoControlador();
		$resultado = $objPlazo->listarPlazo();
	?>

	<!-- lista de usuarios -->
	<?php if (count($resultado)==0) { ?>
		
		<div class="alert alert-warning" role="alert">
		  	<b>Plazos no encontrados</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php }else{  $count = 1; ?>

			<table class="table table-hover">
				<thead>
					<th scope="col">N°</th>
					<th scope="col">Tiempo</th>
					<th scope="col">Valor</th>
					<th scope="col">Credito</th>
				</thead>
				<tbody>

		<?php foreach ($resultado as $key => $result) { ?>

				<tr class="table-info">
					<td><?php echo $count ?></td>
					<td><?php echo $result['tiempo']; ?></td>
					<td><?php echo $result['valor']; ?></td>
					<td><?php echo $result['nombre_credito']; ?></td>
					<td><a href="editarPlazo.php?cod=<?php echo $result['id_pla']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a onclick="return confirm('Quiere eliminar Plazo?')" href="eliminarPlazo.php?cod=<?php echo $result['id_pla']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>

		<?php $count ++ ; } ?>			
			</tbody>
		</table>
	<?php } ?>	
</div>	

<?php include '../layouts/footer.php'; ?>