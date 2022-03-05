<?php 

include '../../modelo/Amortizacion.php';


class AmortizacionControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new Amortizacion();
	}



//--------------------------------------------------------

	function listarAmortizacion(){

		$res=$this->objModelo->listarAmortizacion();
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

	function seleccionarAmortizacion($id){

		$res=$this->objModelo->seleccionarAmortizacion($id);
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

	function editarAmortizacion($id,$nombre,$tiempo,$valor,$creditoId){

		$res=$this->objModelo->editarAmortizacion($id,$nombre,$tiempo,$valor,$creditoId);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarAmortizacion($id){

		$res=$this->objModelo->eliminarAmortizacion($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearAmortizacion($nombre,$tiempo,$valor,$creditoId){

		$res=$this->objModelo->registrarAmortizacion($nombre,$tiempo,$valor,$creditoId);

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