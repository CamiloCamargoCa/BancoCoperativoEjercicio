<?php


include 'Conexion.php';

 class TipoCredito{

 	private $id_TipoCredito;
 	private $nombre_TipoCredito;
 	private $ap_gracia;
 	private $id_pago;

	function registrarTipoCredito($nombre,$ap_gracia,$idpago){

		$this->nombre_TipoCredito=$nombre;
		$this->ap_gracia=$ap_gracia;
		$this->id_pago=$idpago;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO tipo_credito (nombre_credito,ap_gracia,id_pago) VALUES ('$this->nombre_TipoCredito','$this->ap_gracia','$this->id_pago')");
		try {
		  $res->execute();
		  return true;
		} catch(PDOException $e) {
		  // echo 'Error: ' . $e->getMessage();
			return false;
		} finally {
		  $conx=null;
		}

	}

	function editarTipoCredito($id,$nombre,$ap_gracia,$idpago){

		$this->id_TipoCredito=$id;
		$this->nombre_TipoCredito=$nombre;
		$this->ap_gracia=$ap_gracia;
		$this->id_pago=$idpago;

		$conx = new Conexion();

		$res=$conx->prepare("UPDATE tipo_credito SET nombre_credito='$this->nombre_TipoCredito', ap_gracia='$this->ap_gracia', id_pago='$this->id_pago'"." WHERE id_tipo_cre='$this->id_TipoCredito'");

		try {
		  $res->execute();
		  return true;
		} catch(PDOException $e) {
		  // return 'Error: ' . $e->getMessage();
		 return false;
		} finally {
		  $conx=null;
		}

	}

	function eliminarTipoCredito($id){

		$this->id_TipoCredito=$id;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM tipo_credito WHERE id_tipo_cre='$this->id_TipoCredito'");
		try {
		  $res->execute();
		  return true;
		} catch(PDOException $e) {
		  	// echo 'Error: ' . $e->getMessage();
		  return false;
		} finally {
		  $conx=null;
		}

	}

	function listarTipoCredito(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT tc.id_tipo_cre,tc.nombre_credito,tc.ap_gracia,tp.nombre_pago FROM `tipo_credito` tc inner join tipo_pago tp on tc.id_pago=tp.id_pago");
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

	function seleccionarTipoCredito($id){

		$this->id_TipoCredito=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT tc.id_tipo_cre,tc.nombre_credito,tc.ap_gracia,tc.id_pago,tp.nombre_pago FROM `tipo_credito` tc inner join tipo_pago tp on tc.id_pago=tp.id_pago WHERE tc.id_tipo_cre='$this->id_TipoCredito'");
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

	function listarPago(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM tipo_pago");
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


 }

?>