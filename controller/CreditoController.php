<?php 

include '../../modelo/Credito.php';


class CreditoControlador{

	private $objModelo;

	public function __construct(){
		$this->objModelo = new Credito();
	}



//--------------------------------------------------------

	function listarCredito(){

		$res=$this->objModelo->listarCredito();
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

	function seleccionarCredito($id_cre){

		$res=$this->objModelo->seleccionarCredito($id_cre);
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

	function editarCredito($id_cre,$id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago){

		$res=$this->objModelo->editarCredito($id_cre,$id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago);
		
		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function eliminarCredito($id_cre){

		$res=$this->objModelo->eliminarCredito($id);

		if ($res==true) {
			return true;
		}else{
			return false;
			// return $res;
		}
	}

//--------------------------------------------------------

	function crearCredito($id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago){

		$res=$this->objModelo->registrarCredito($id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago);

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

//--------------------------------------------------------

	function seleccionarTipoCredito($id){

		$this->id_TipoCredito=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT tc.id_tipo_cre,tc.nombre_credito,tc.ap_gracia,tc.id_pago,tp.nombre_pago,tp.tipo_tabla FROM `tipo_credito` tc inner join tipo_pago tp on tc.id_pago=tp.id_pago WHERE tc.id_tipo_cre='$this->id_TipoCredito'");
		try {
		  $res->execute();
		  return  $res;
		} catch(PDOException $e) {
		  // echo 'Error: ' . $e->getMessage();
			return false;
		} finally {
		  $conx=null;
		}

	}

//--------------------------------------------------------

	function listarAmortizacion($idTipoCredito){

		$res=$this->objModelo->listarAmortizacion($idTipoCredito);
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

	function listarPlazo($idTipoCredito){

		$res=$this->objModelo->listarPlazo($idTipoCredito);
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