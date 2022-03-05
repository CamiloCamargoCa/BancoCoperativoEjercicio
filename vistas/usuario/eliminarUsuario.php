<?php 

	include '../../controller/UsuarioController.php';

	$id = @$_REQUEST['cod'];
		
	if ($id == 0 || $id==null || $id='') { 

		echo'
			<script type="text/javascript">
              location.href="listaUsuarios.php?cod='.$id.'&men=2";
			</script>

		';
		

	}else{

		$id = $_REQUEST['cod'];
		$objUsuContro = new UsuarioControlador();
		$resultado = $objUsuContro->eliminarUsuario($id);

		if ($resultado==true) {
			echo '
				
			<script type="text/javascript">
              location.href="listaUsuarios.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="listaUsuarios.php?men=2";
			</script>

			';
		}
	}


?>