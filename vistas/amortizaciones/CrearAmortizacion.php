<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/AmortizacionController.php'; ?>

<?php $objAmortizacion = new AmortizacionControlador(); ?>


<div class="container">
	<br>
	<center><h3>Crear Amortizacion</h3></center>

		<form action="crearAmortizacion.php" method="post">

			<div class="form-group">
		      <label for="nombre">Nombre</label>
		      <input type="text" name="nombre" id="nombre" placeholder='Registre nombre del periodo' class="form-control" required="">
		    </div>

			<div class="form-group">
		      <label for="nombre">Tiempo</label>
		      <select name="tiempo" id="tiempo" placeholder='Seleccione una Opción' class="form-control" required="">
		      		<option value="Dias">Días</option>
		      		<option value="Meses">Meses</option>
		      		<option value="Bimestres">Bimestres</option>
		      		<option value="Trimestres">Trimestres</option>
		      		<option value="Semestres">Semestres</option>
		      		<option value="Años">Años</option>
		      </select>
		    </div>

		    <div class="form-group">
		      <label for="nombre">Valor</label>
		      <input type="text" name="valor" id="valor" placeholder='Registre el valor' class="form-control" required="">
		    </div>

		    <div class="form-group">
		      <label for="nombre">Tipo Credio</label>
		      	<select name="tipo_cred_id" id="tipo_cred_id" class="form-control" required="">
		      		<option value="" disabled selected>Seleccione Una Opcion</option>
			      	<?php
						$creditos = $objAmortizacion->listarTipoCredito(); 
						foreach ($creditos as $key => $credito) {
							echo '<option value="'.$credito['id_tipo_cre'].'">'.$credito['nombre_credito'].'</option>
							option';
						}
				 	?>
				</select>
		    </div>

			<div class="form-group">
		    	<a href="listarAmortizaciones.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="Crear">
			</div>
		</form>


<?php 	 


if (isset($_POST['nombre']) && !empty($_POST['nombre']) &&
	isset($_POST['tiempo']) && !empty($_POST['tiempo']) &&
 	isset($_POST['valor']) && !empty($_POST['valor']) &&
 	isset($_POST['tipo_cred_id']) && !empty($_POST['tipo_cred_id'])) {

	$nombre = $_POST['nombre'];
	$tiempo = $_POST['tiempo'];
	$valor = $_POST['valor'];
	$tipo_cred_id = $_POST['tipo_cred_id'];
	
	$resultado = $objAmortizacion->crearAmortizacion($nombre,$tiempo,$valor,$tipo_cred_id); 


	if ($resultado==true) {
		echo '
			
		<script type="text/javascript">
          location.href="listarAmortizaciones.php?men=3";
		</script>
		';

	}else{
		echo'
		<script type="text/javascript">
          location.href="listarAmortizaciones.php?men=4";
		</script>

		';
	}
}

?>

<?php include '../layouts/footer.php'; ?>
