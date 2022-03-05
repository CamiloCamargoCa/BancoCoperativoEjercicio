<?php 

	include '../../controller/AmortizacionController.php';

	if (isset($_POST['nombre']) && !empty($_POST['nombre']) &&
		isset($_POST['id_am']) && !empty($_POST['id_am']) &&
		isset($_POST['tiempo']) && !empty($_POST['tiempo']) &&
 		isset($_POST['valor']) && !empty($_POST['valor']) &&
 		isset($_POST['tipo_cred_id']) && !empty($_POST['tipo_cred_id'])) {

		$id = $_POST['id_am'];
		$nombre = $_POST['nombre'];
		$tiempo = $_POST['tiempo'];
		$valor = $_POST['valor'];
		$tipo_cred_id = $_POST['tipo_cred_id'];


		$objAmortizacion = new AmortizacionControlador();
		$resultado = $objAmortizacion->editarAmortizacion($id,$nombre,$tiempo,$valor,$tipo_cred_id);

		if ($resultado==true) {
			echo '
			<script type="text/javascript">
              location.href="editarAmortizacion.php?cod='.$id.'&men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="editarAmortizacion.php?cod='.$id.'&men=2";
			</script>
			';
		}
	}else{
		$id = $_POST['id_pla'];
		echo'
			<script type="text/javascript">
              location.href="editarAmortizacion.php?cod='.$id.'&men=2";
			</script>

		';
	}


?>