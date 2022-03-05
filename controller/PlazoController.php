<?php 

include '../../modelo/Plazo.php';


class PlazoControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new Plazo();
	}



//--------------------------------------------------------

	function listarPlazo(){

		$res=$this->objModelo->listarPlazo();
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

	function seleccionarPlazo($id){

		$res=$this->objModelo->seleccionarPlazo($id);
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

	function editarPlazo($id,$tiempo,$valor,$creditoId){

		$res=$this->objModelo->editarPlazo($id,$tiempo,$valor,$creditoId);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarPlazo($id){

		$res=$this->objModelo->eliminarPlazo($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearPlazo($tiempo,$valor,$creditoId){

		$res=$this->objModelo->registrarPlazo($tiempo,$valor,$creditoId);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}


//--------------------------------------------------------

	function listarTipoCredito(){

		$res=$this->objModelo->listarTipoCredito();
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

}
//fin de la clase


?>