<?php 

include '../../modelo/TipoCredito.php';


class TipoCreditoControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new TipoCredito();
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

//--------------------------------------------------------

	function seleccionarTipoCredito($id){

		$res=$this->objModelo->seleccionarTipoCredito($id);
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

	function editarTipoCredito($id,$nombre,$ap_gracia,$id_pago){

		$res=$this->objModelo->editarTipoCredito($id,$nombre,$ap_gracia,$id_pago);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarTipoCredito($id){

		$res=$this->objModelo->eliminarTipoCredito($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearTipoCredito($nombre,$ap_gracia,$id_pago){

		$res=$this->objModelo->registrarTipoCredito($nombre,$ap_gracia,$id_pago);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
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

}
//fin de la clase


?>