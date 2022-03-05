<?php 

include '../../controller/UsuarioController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['txtcontrasena']) && !empty($_POST['txtcontrasena']) && isset($_POST['txtusuario']) && !empty($_POST['txtusuario'])) {
	
		$usu = $_POST['txtusuario'];
		$pass = $_POST['txtcontrasena'];
		$objUsuContro = new UsuarioControlador();
		$resultado = $objUsuContro->validarUsuario($usu,$pass);
	
		if (count($resultado)>0) {	
			foreach ($resultado as $key => $result) {
				
				session_start();
				$_SESSION["usuario"] = array(
					"id" => $result['id_usu'],
					"alias" => $result['alias'],
					"usuario" => $result['usuario']
				);				
			}

			echo '
			<script type="text/javascript">
              location.href="index.php?men=1";
			</script>
			';

		}else{
			echo'
			<script type="text/javascript">
              location.href="index.php?men=2";
			</script>

			';
		}
	}
}  

?>
	