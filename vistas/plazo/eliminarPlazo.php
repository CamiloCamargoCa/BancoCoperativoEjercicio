<?php 

	include '../../controller/PlazoController.php';

	$id = @$_REQUEST['cod'];
		
	if ($id == 0 || $id==null || $id='') { 

		echo'
			<script type="text/javascript">
              location.href="listarPlazos.php?cod='.$id.'&men=2";
			</script>
		';
		
	}else{

		$id = $_REQUEST['cod'];
		$objPlazo = new PlazoControlador();
		$resultado = $objPlazo->eliminarPlazo($id);

		if ($resultado==true) {
			echo '		
			<script type="text/javascript">
              location.href="listarPlazos.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="listarPlazos.php?men=2";
			</script>

			';
		}
	}


?>