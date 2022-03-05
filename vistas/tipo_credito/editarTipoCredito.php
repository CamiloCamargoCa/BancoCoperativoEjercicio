<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/TipoCreditoController.php'; ?>
<div class="container">
	<br>
	<center><h3>Editar Tipo de Credito</h3></center>

	<!-- mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Tipo de Credito Editado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Tipo de Credito no pudo ser editado!</b>
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
		  	<b>Error al buscar Tipo de Credito</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php 

		}else{
		$id = $_REQUEST['cod'];
		$objTipoCredControl = new TipoCreditoControlador();
		$resultado = $objTipoCredControl->seleccionarTipoCredito($id);
		$pagos = $objTipoCredControl->listarPago();

			foreach ($resultado as $key => $resul) {
				// print_r($resul);
	?>

		<form action="modificarTipoCredito.php" method="post" class="editUser">
			
			<input type="hidden" class="form-control" name="id_tipo_cre" value="<?php echo $resul['id_tipo_cre']; ?>">

			<div class="form-group">
		      <label for="nombre">Tipo Credito</label>
		      <input type="text" class="form-control" name="nombre_tc" value="<?php echo $resul['nombre_credito']; ?>" required="" >
		    </div>

		    <div class="form-group">
		      <label for="nombre">Pago Asociado</label>
		      <select name="tipo_pago" class="form-control" id="tipo_pago" required="">
				<?php
				$selected='';
				foreach ($pagos as $key2 => $pago) {
					if ($pago['id_pago']==$resul['id_pago']) {
						$selected='selected=""';
					}else{
						$selected='';
					}

					echo '<option value="'.$pago['id_pago'].'" '.$selected.'>'.$pago['nombre_pago'].'</option>';
				}
				?>
		      </select>	
		    </div>

		    <div class="form-group">
		      <label for="nombre">Periodo de Gracia</label>
		      	<?php 
		      		$checked = '';
		      		if ($resul['ap_gracia']==1){
		      			$checked = 'checked=""';
		      		}
		   		?>
		      <input type="checkbox" class="" <?php echo $checked; ?> name="ap_gracia" id="ap_gracia">
		    </div>

			<div class="form-group">
		    	<a href="listarTipoCreditos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="editar">
			</div>
		</form>

	<?php 

			} 
		}

	?>

</div>	
<?php include '../layouts/footer.php'; ?>

