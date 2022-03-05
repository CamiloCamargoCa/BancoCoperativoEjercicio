<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/AmortizacionController.php'; ?>


<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<h3 class="col-7">Amortizaciones</h3>
		<a href="crearAmortizacion.php" class="btn btn-info col-5 col-sm-4 col-md-4 col-lg-3">Adicionar Amortización</a>
	</div>
	<br>
	<!-- Mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-dark" role="alert">
		  	<b>Amortizacion eliminado correctamente</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Amortizacion no pudo ser eliminado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif ($mensaje==3) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Amortizacion Creado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==4) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Amortizacion no pudo ser creado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>
	
	<!-- llamado del objeto -->
	<?php 
		$objAmortizacion = new AmortizacionControlador();
		$resultado = $objAmortizacion->listarAmortizacion();
	?>

	<!-- lista de usuarios -->
	<?php if (count($resultado)==0) { ?>
		
		<div class="alert alert-warning" role="alert">
		  	<b>Amortizacion no encontrada</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php }else{  $count = 1; ?>

			<table class="table table-hover">
				<thead>
					<th scope="col">N°</th>
					<th scope="col">Nombre</th>
					<th scope="col">Tiempo</th>
					<th scope="col">Valor</th>
					<th scope="col">Credito</th>
				</thead>
				<tbody>

		<?php foreach ($resultado as $key => $result) { ?>

				<tr class="table-info">
					<td><?php echo $count ?></td>
					<td><?php echo $result['nombre']; ?></td>
					<td><?php echo $result['tiempo']; ?></td>
					<td><?php echo $result['valor']; ?></td>
					<td><?php echo $result['nombre_credito']; ?></td>
					<td><a href="editarAmortizacion.php?cod=<?php echo $result['id_am']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a onclick="return confirm('Quiere eliminar Amortizacion?')" href="eliminarAmortizacion.php?cod=<?php echo $result['id_am']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>

		<?php $count ++ ; } ?>			
			</tbody>
		</table>
	<?php } ?>	
</div>	

<?php include '../layouts/footer.php'; ?>