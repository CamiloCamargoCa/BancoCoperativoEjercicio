<?php 

	include '../../controller/PlazoController.php';

	if (isset($_POST['id_pla']) && !empty($_POST['id_pla']) &&
		isset($_POST['tiempo']) && !empty($_POST['tiempo']) &&
 		isset($_POST['valor']) && !empty($_POST['valor']) &&
 		isset($_POST['tipo_cred_id']) && !empty($_POST['tipo_cred_id'])) {

		$id = $_POST['id_pla'];
		$tiempo = $_POST['tiempo'];
		$valor = $_POST['valor'];
		$tipo_cred_id = $_POST['tipo_cred_id'];


		$objPlazo = new PlazoControlador();
		$resultado = $objPlazo->editarPlazo($id,$tiempo,$valor,$tipo_cred_id);

		if ($resultado==true) {
			echo '
			<script type="text/javascript">
              location.href="editarPlazo.php?cod='.$id.'&men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="editarPlazo.php?cod='.$id.'&men=2";
			</script>
			';
		}
	}else{
		$id = $_POST['id_pla'];
		echo'
			<script type="text/javascript">
              location.href="editarPlazo.php?cod='.$id.'&men=2";
			</script>

		';
	}


?>