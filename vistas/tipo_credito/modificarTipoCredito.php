<?php 

	include '../../controller/TipoCreditoController.php';

	if (isset($_POST['id_tipo_cre']) && !empty($_POST['id_tipo_cre']) &&
		isset($_POST['nombre_tc']) && !empty($_POST['nombre_tc']) &&
		isset($_POST['tipo_pago']) && !empty($_POST['tipo_pago'])) {

		$id = $_POST['id_tipo_cre'];
		$nombre = $_POST['nombre_tc'];
		$pago = $_POST['tipo_pago'];
		$ap_gracia = 0;

		if (isset($_POST['ap_gracia']) && $_POST['ap_gracia'] == 'on') {
			$ap_gracia = 1;
		}else{
			$ap_gracia = 0;
		}

				// echo $id;
				// echo $nombre;

				// exit;

		$objTipoCredControl = new TipoCreditoControlador();
		$resultado = $objTipoCredControl->editarTipoCredito($id,$nombre,$ap_gracia,$pago);

		if ($resultado==true) {
			echo '
			<script type="text/javascript">
              location.href="editarTipoCredito.php?cod='.$id.'&men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="editarTipoCredito.php?cod='.$id.'&men=2";
			</script>
			';
		}
	}else{
		$id = $_POST['id_pago'];
		echo'
			<script type="text/javascript">
              location.href="editarTipoCredito.php?cod='.$id.'&men=2";
			</script>

		';
	}


?>