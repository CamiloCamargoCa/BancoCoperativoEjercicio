<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PagoController.php'; ?>
<div class="container">
	<br>
	<center><h3>Editar Tipo de Pago</h3></center>

	<!-- mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Tipo de Pago Editado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo de Pago no pudo ser editado!</b>
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
		  	<b>Error al buscar Tipo de Pago</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php 

		}else{
		$id = $_REQUEST['cod'];
		$objPagoContro = new PagoControlador();
		$resultado = $objPagoContro->seleccionarPago($id);

			foreach ($resultado as $key => $resul) {
				// print_r($resul);
	?>

		<form action="modificarPago.php" method="post" class="editUser">
			
			<input type="hidden" class="form-control" name="id_pago" value="<?php echo $resul['id_pago']; ?>">

			<div class="form-group">
		      <label for="exampleInputPassword1">Nombre Tipo Pago</label>
		      <input type="text" class="form-control" name="nombre_pago" value="<?php echo $resul['nombre_pago']; ?>" required="" >
		    </div>

		    <!-- Tipo 1  TABLA IGUALES A CAPITAL -->
			<!-- Tipo 2  TABLA DE AMORTIZACION GRADUAL -->
		    <div class="form-group">
		      <label for="nombre">Tipo Tabla</label>
		      <select name="tipo_tabla" id="tipo_tabla" class="form-control">
		      	<?php
		      		$selected1 = '';
		      		$selected2 = '';
		      		if ($resul['tipo_tabla'] == 1) {
		      			$selected1 = 'selected=""';
		      		}elseif($resul['tipo_tabla'] == 2){
		      			$selected2 = 'selected=""';
		      		}

		      	?>
		      	<option value="" selected disabled>Seleccione una opción</option>
		      	<option <?php echo $selected1; ?> value="1">1 Tabla Iguales a Capital</option>
		      	<option <?php echo $selected2; ?> value="2">2 Tabla de Amortización Gradual</option>
		      </select>
		    </div>

			<div class="form-group">
		    	<a href="listarPagos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="editar">
			</div>
		</form>

	<?php 

			} 
		}

	?>

</div>	
<?php include '../layouts/footer.php'; ?>

