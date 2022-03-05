<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PlazoController.php'; ?>

<?php $objPlazo = new PlazoControlador(); ?>


<div class="container">
	<br>
	<center><h3>Crear Plazo</h3></center>

		<form action="crearPlazo.php" method="post">

			<div class="form-group">
		      <label for="nombre">Tiempo</label>
		      <select name="tiempo" id="tiempo" placeholder='Seleccione una Opción' class="form-control" required="">
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
		      <input type="text" name="valor" id="valor" placeholder='Registre el valor' class="form-control" required="">
		    </div>

		    <div class="form-group">
		      <label for="nombre">Tipo Credio</label>
		      	<select name="tipo_cred_id" id="tipo_cred_id" class="form-control" required="">
		      		<option value="" disabled selected="">Seleccione Una Opcion</option>
			      	<?php
						$creditos = $objPlazo->listarTipoCredito(); 
						foreach ($creditos as $key => $credito) {
							echo '<option value="'.$credito['id_tipo_cre'].'">'.$credito['nombre_credito'].'</option>
							option';
						}
				 	?>
				</select>
		    </div>

			<div class="form-group">
		    	<a href="listarPlazos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="Crear">
			</div>
		</form>


<?php 	 


if (isset($_POST['tiempo']) && !empty($_POST['tiempo']) &&
 	isset($_POST['valor']) && !empty($_POST['valor']) &&
 	isset($_POST['tipo_cred_id']) && !empty($_POST['tipo_cred_id'])) {

	$tiempo = $_POST['tiempo'];
	$valor = $_POST['valor'];
	$tipo_cred_id = $_POST['tipo_cred_id'];
	
	$resultado = $objPlazo->crearPlazo($tiempo,$valor,$tipo_cred_id); 


	if ($resultado==true) {
		echo '
			
		<script type="text/javascript">
          location.href="listarPlazos.php?men=3";
		</script>
		';

	}else{
		echo'
		<script type="text/javascript">
          location.href="listarPlazos.php?men=4";
		</script>

		';
	}
}

?>

<?php include '../layouts/footer.php'; ?>
