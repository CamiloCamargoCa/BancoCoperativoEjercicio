<?php 

	include '../../controller/PagoController.php';

	$id = @$_REQUEST['cod'];
		
	if ($id == 0 || $id==null || $id='') { 

		echo'
			<script type="text/javascript">
              location.href="listarPagos.php?cod='.$id.'&men=2";
			</script>

		';
		

	}else{

		$id = $_REQUEST['cod'];
		$objPagoContro = new PagoControlador();
		$resultado = $objPagoContro->eliminarPago($id);

		if ($resultado==true) {
			echo '		
			<script type="text/javascript">
              location.href="listarPagos.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="listarPagos.php?men=2";
			</script>

			';
		}
	}


?>