<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PagoController.php'; ?>


<div class="container-fluid">
	<br>
	<div class="row justify-content-center">
		<h3 class="col-8">Tipos de Pago</h3>
		<a href="crearPago.php" class="btn btn-info col-4 col-sm-3 col-md-2	">Adicionar Pago</a>
	</div>
	<br>
	<!-- Mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-dark" role="alert">
		  	<b>Tipo Pago eliminado correctamente</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo Pago no pudo ser eliminado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif ($mensaje==3) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Tipo Pago Creado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==4) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo Pago no pudo ser creado!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }else{} ?>
	
	<!-- llamado del objeto -->
	<?php 
		$objPagoContro = new PagoControlador();
		$resultado = $objPagoContro->listarPago();
	?>

	<!-- lista de usuarios -->
	<?php if (count($resultado)==0) { ?>
		
		<div class="alert alert-warning" role="alert">
		  	<b>Tipo de Pagos no encontrados</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php }else{  $count = 1; ?>

			<table class="table table-hover">
				<thead>
					<th scope="col">N°</th>
					<th scope="col">Nombre</th>
					<th scope="col">Tipo Tabla</th>
					<th scope="col">Editar</th>
					<th scope="col">Eliminar</th>
				</thead>
				<tbody>

		<?php foreach ($resultado as $key => $result) { ?>

				<tr class="table-info">
					<td><?php echo $count ?></td>
					<td><?php echo $result['nombre_pago']; ?></td>
					<!-- Tipo 1  TABLA IGUALES A CAPITAL -->
					<!-- Tipo 2  TABLA DE AMORTIZACION GRADUAL -->
					<td><?php echo ($result['tipo_tabla']==1) ? '1 TABLA IGUALES A CAPITAL':'2 TABLA DE AMORTIZACION GRADUAL'; ?></td>
					<td><a href="editarPago.php?cod=<?php echo $result['id_pago']; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a onclick="return confirm('Quiere eliminar tipo de pago?')" href="eliminarPago.php?cod=<?php echo $result['id_pago']; ?>"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
				</tr>

		<?php $count ++ ; } ?>			
			</tbody>
		</table>
	<?php } ?>	
</div>	

<?php include '../layouts/footer.php'; ?>