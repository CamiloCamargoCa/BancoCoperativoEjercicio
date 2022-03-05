<?php 

include '../../modelo/Pago.php';


class PagoControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new Pago();
	}

//--------------------------------------------------------

	function listarPago(){

		$res=$this->objModelo->listarPago();
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

	function seleccionarPago($id){

		$res=$this->objModelo->seleccionarPago($id);
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

	function editarPago($id,$nombre,$tipo_tabla){

		$res=$this->objModelo->editarPago($id,$nombre,$tipo_tabla);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarPago($id){

		$res=$this->objModelo->eliminarPago($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearPago($nombre,$tipo_tabla){

		$res=$this->objModelo->registrarPago($nombre,$tipo_tabla);

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