<?php include '../layouts/head.php'; ?>
<?php include '../layouts/menu.php'; ?>
<?php include '../../controller/PagoController.php'; ?>

<div class="container">
	<br>
	<center><h3>Crear Tipo de Pago</h3></center>

		<form action="crearPago.php" method="post">

			<div class="form-group">
		      <label for="nombre">Nombre</label>
		      <input type="text" class="form-control" name="nombre_pago" required="" >
		    </div>

			<!-- Tipo 1  TABLA IGUALES A CAPITAL -->
			<!-- Tipo 2  TABLA DE AMORTIZACION GRADUAL -->
		    <div class="form-group">
		      <label for="nombre">Tipo Tabla</label>
		      <select name="tipo_tabla" id="tipo_tabla" class="form-control">
		      	<option value="" selected disabled>Seleccione una opción</option>
		      	<option value="1">1 Tabla Iguales a Capital</option>
		      	<option value="2">2 Tabla de Amortización Gradual</option>
		      </select>
		    </div>

			<div class="form-group">
		    	<a href="listarPagos.php" class="btn btn-primary">Atras</a>
		    	<input type="submit" class="btn btn-success" value="Crear">
			</div>
		</form>


<?php 	 


if (isset($_POST['nombre_pago']) && !empty($_POST['nombre_pago']) &&
	isset($_POST['tipo_tabla']) && !empty($_POST['tipo_tabla'])) {

	$nombre_pago = $_POST['nombre_pago'];
	$tipo_tabla = $_POST['tipo_tabla'];
	
	$objPagoContro = new PagoControlador();
	$resultado = $objPagoContro->crearPago($nombre_pago,$tipo_tabla);

	if ($resultado==true) {
		echo '
			
		<script type="text/javascript">
          location.href="listarPagos.php?men=3";
		</script>
		';

	}else{
		echo'
		<script type="text/javascript">
          location.href="listarPagos.php?men=4";
		</script>

		';
	}
}

?>

</div>	
<?php include '../layouts/footer.php'; ?>
