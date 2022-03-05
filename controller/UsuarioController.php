<?php 

include '../../modelo/Usuario.php';


class UsuarioControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new Usuario();
	}


	function validarUsuario($usu,$pass){

		$res=$this->objModelo->loginUsuario($usu,$pass);
		$datos=[];
		foreach ($res as $row) {
			$datos[]=$row;
		}
		if (count($datos)>0) {
			return $datos;
		}else{
			echo "fallo";
		}
	}

//--------------------------------------------------------

	function listarUsuario(){

		$res=$this->objModelo->listarUsuario();
		$datos=[];
		foreach ($res as $row) {
			$datos[]=$row;
		}
		if (count($datos)>0) {
			return $datos;
		}else{
			echo "";
		}
	}

//--------------------------------------------------------

	function seleccionarUsuario($id){

		$res=$this->objModelo->seleccionarUsuario($id);
		$datos=[];
		foreach ($res as $row) {
			$datos[]=$row;
		}
		if (count($datos)>0) {
			return $datos;
		}else{
			echo "";
			// print_r($res);
		}
	}

//--------------------------------------------------------

	function editarUsuario($id_usu,$alias,$usuario,$contrasena){

		$res=$this->objModelo->editarUsuario($id_usu,$alias,$usuario,$contrasena);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarUsuario($id){

		$res=$this->objModelo->eliminarUsuario($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearUsuario($alias,$usuario,$contrasena){

		$res=$this->objModelo->registrarUsuario($alias,$usuario,$contrasena);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

}
//fin de la clase


?>