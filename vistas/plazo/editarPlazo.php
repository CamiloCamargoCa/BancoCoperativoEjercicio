<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PlazoController.php'; ?>
<div class="container">
	<br>
	<center><h3>Editar Plazo</h3></center>

	<!-- mensajes -->
	<?php 
	$mensaje = @$_REQUEST['men'];
	if ($mensaje==1) { ?>
		<div class="alert alert-success" role="alert">
		  	<b>Plazo Editado Correctamente!</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	<?php }elseif($mensaje==2) { ?>
		<div class="alert alert-danger" role="alert">
		  	<b>Plazo no pudo ser editado!</b>
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
		  	<b>Error al buscar Plazo</b>
		  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>

	<?php 

		}else{
		$id = $_REQUEST['cod'];
		$objPlazo = new PlazoControlador();
		$resultado = $objPlazo->seleccionarPlazo($id);

			foreach ($resultado as $key => $resul) {
				// print_r($resul);
	?>

		<form action="modificarPlazo.php" method="post" class="editUser">
			
			<input type="hidden" class="form-control" name="id_pla" value="<?php echo $resul['id_pla']; ?>">

			<div class="form-group">
		      <label for="nombre">Tiempo</label>
		      <select name="tiempo" id="tiempo" placeholder='Seleccione una Opción' class="form-control" required="">
		      	<?php 
		      		echo '<option value="'.$resul['tiempo'].'" '.$selected.'>'.$resul['tiempo'].'</option>';
		      	?>
		      		<option value="Dia">Día</option>
		      		<option value="Meses">Meses</option>
		      		<option value="Bimestres">Bimestres</option>
		      		<option value="Trimestres">Trimestres</option>
		      		<option value="Semestres">Semestres</option>
		      		<option value="Años">Años</option>
		      </select>
		    </div>

		    <div class="form-group">
		      <label for="nombre">Valor</label>
		      <input type="text" name="valor" id="valor" placeholder='Registre el valor' value="<?php echo $resul['valor']; ?>"	class="form-control" required="">
		    </div>

		    <div class="form-group">
		      <label for="nombre">Tipo Credio</label>
		      	<select name="tipo_cred_id" id="tipo_cred_id" class="form-control" required="">
		      		<option value="" disabled selected="">Seleccione Una Opcion</option>
			      	<?php
						$creditos = $objPlazo->listarTipoCredito(); 
						$selected = '';
						foreach ($creditos as $key => $credito) {

							if ($credito['id_tipo_cre']==$resul['tipo_credito']) {
								$selected='selected=""';
							}else{
								$selected='';
							}
							echo '<option value="'.$credito['id_tipo_cre'].'" '.$selected.'>'.$credito['nombre_credito'].'</option>
							option';
						}
				 	?>
				</select>
		    </div>

			<div class="form-group">
		    	<a href="listarPlazos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="editar">
			</div>
		</form>

	<?php 

			} 
		}

	?>

</div>	
<?php include '../layouts/footer.php'; ?>

