<?php 

	include '../../controller/PagoController.php';

	if (isset($_POST['id_pago']) && !empty($_POST['id_pago']) &&
		isset($_POST['nombre_pago']) && !empty($_POST['nombre_pago']) &&
		isset($_POST['tipo_tabla']) && !empty($_POST['tipo_tabla'])) {

		$id = $_POST['id_pago'];
		$nombre = $_POST['nombre_pago'];
		$tipo_tabla = $_POST['tipo_tabla'];
				// echo $id;
				// echo $nombre;

				// exit;

		$objPagoContro = new PagoControlador();
		$resultado = $objPagoContro->editarPago($id,$nombre,$tipo_tabla);

		if ($resultado==true) {
			echo '
				
			<script type="text/javascript">
              location.href="editarPago.php?cod='.$id.'&men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="editarPago.php?cod='.$id.'&men=2";
			</script>
			';
		}
	}else{
		$id = $_POST['id_pago'];
		echo'
			<script type="text/javascript">
              location.href="editarPago.php?cod='.$id.'&men=2";
			</script>

		';
	}


?>