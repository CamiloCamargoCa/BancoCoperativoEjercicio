<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/TipoCreditoController.php'; ?>

<?php $objTipoCredControl = new TipoCreditoControlador(); ?>

<div class="container">
	<br>
	<center><h3>Crear Tipo de Credito</h3></center>

		<form action="crearTipoCredito.php" method="post">

			<div class="form-group">
		      <label for="nombre">Tipo Credito</label>
		      <input type="text" class="form-control" name="nombre_tc" required="" id="nombre_tc">
		    </div>

		    <div class="form-group">
		      <label for="nombre">Pago Asociado</label>
		      <select name="tipo_pago" class="form-control" id="tipo_pago" required="">
		      	<option value="" disabled selected>Seleccione Una Opcion</option>
				<?php
				$pagos = $objTipoCredControl->listarPago(); 
				foreach ($pagos as $key => $pago) {
					echo '<option value="'.$pago['id_pago'].'">'.$pago['nombre_pago'].'</option>';
				}
				?>
		      </select>	
		    </div>

		    <div class="form-group">
		      <label for="nombre">Periodo de Gracia</label>
		      <input type="checkbox" class="" name="ap_gracia" id="ap_gracia">
		    </div>

			<div class="form-group">
		    	<a href="listarTipoCreditos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="Crear">
			</div>
		</form>


<?php 	 


if (isset($_POST['nombre_tc']) && !empty($_POST['nombre_tc']) &&
	isset($_POST['tipo_pago']) && !empty($_POST['tipo_pago'])) {

	$nombre = $_POST['nombre_tc'];
	$pagoid = $_POST['tipo_pago'];
	$ap_gracia = 0;


	if (isset($_POST['ap_gracia']) && $_POST['ap_gracia'] == 'on') {
		$ap_gracia = 1;
	}else{
		$ap_gracia = 0;
	}
	
	
	$resultado = $objTipoCredControl->crearTipoCredito($nombre,$ap_gracia,$pagoid);

	if ($resultado==true) {
		echo '
		<script type="text/javascript">
          location.href="listarTipoCreditos.php?men=3";
		</script>
		';

	}else{
		echo'
		<script type="text/javascript">
          location.href="listarTipoCreditos.php?men=4";
		</script>

		';
	}
}

?>

</div>	
<?php include '../layouts/footer.php'; ?>
