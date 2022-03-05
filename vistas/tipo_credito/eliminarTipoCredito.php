<?php 

	include '../../controller/TipoCreditoController.php';

	$id = @$_REQUEST['cod'];
		
	if ($id == 0 || $id==null || $id='') { 

		echo'
			<script type="text/javascript">
              location.href="listarTipoCreditos.php?cod='.$id.'&men=2";
			</script>
		';
		
	}else{

		$id = $_REQUEST['cod'];
		$objTipoCredControl = new TipoCreditoControlador();
		$resultado = $objTipoCredControl->eliminarTipoCredito($id);

		if ($resultado==true) {
			echo '		
			<script type="text/javascript">
              location.href="listarTipoCreditos.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="listarTipoCreditos.php?men=2";
			</script>

			';
		}
	}


?>