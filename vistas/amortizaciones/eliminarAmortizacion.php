<?php 

	include '../../controller/AmortizacionController.php';

	$id = @$_REQUEST['cod'];
		
	if ($id == 0 || $id==null || $id='') { 

		echo'
			<script type="text/javascript">
              location.href="listarAmortizaciones.php?cod='.$id.'&men=2";
			</script>
		';
		
	}else{

		$id = $_REQUEST['cod'];
		$objAmortizacion = new AmortizacionControlador();
		$resultado = $objAmortizacion->eliminarAmortizacion($id);

		if ($resultado==true) {
			echo '		
			<script type="text/javascript">
              location.href="listarAmortizaciones.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="listarAmortizaciones.php?men=2";
			</script>

			';
		}
	}


?>