<?php 

	include '../../controller/UsuarioController.php';

	if (isset($_POST['id_usu']) && !empty($_POST['id_usu']) &&
		isset($_POST['alias']) && !empty($_POST['alias']) &&
		isset($_POST['usuario']) && !empty($_POST['usuario']) &&
		isset($_POST['confircontrasena']) && !empty($_POST['confircontrasena']) &&
		isset($_POST['contrasena']) && !empty($_POST['contrasena'])) {

		$id_usu = $_POST['id_usu'];
		$alias = $_POST['alias'];
		$usuario = $_POST['usuario'];
		$confircontrasena = $_POST['confircontrasena'];
		$contrasena = $_POST['contrasena'];

			// echo $id_usu;
			// echo $alias;
			// echo $usuario;
			// echo $contrasena;

			// exit;

		$objUsuContro = new UsuarioControlador();

		$resultado = $objUsuContro->editarUsuario($id_usu,$alias,$usuario,$contrasena);

		if ($resultado==true) {
			echo '
				
			<script type="text/javascript">
              location.href="editarUsuario.php?cod='.$id_usu.'&men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="editarUsuario.php?cod='.$id_usu.'&men=2";
			</script>

			';
		}
	}else{
		$id_usu = $_POST['id_usu'];
		echo'
			<script type="text/javascript">
              location.href="editarUsuario.php?cod='.$id_usu.'&men=2";
			</script>

		';
	}


?>