<?php


include 'Conexion.php';

 class Pago{

 	private $id_pago;
 	private $nombre_pago;
 	private $tipo_tabla;
	
	

	function registrarPago($nombre,$tipo_tabla){

		$this->nombre_pago=$nombre;
		$this->tipo_tabla=$tipo_tabla;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO tipo_pago (nombre_pago,tipo_tabla) VALUES ('$this->nombre_pago', '$this->tipo_tabla')");
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

	function editarPago($id,$nombre,$tipo_tabla){

		$this->id_pago=$id;
		$this->nombre_pago=$nombre;
		$this->tipo_tabla=$tipo_tabla;

		$conx = new Conexion();

		$res=$conx->prepare("UPDATE tipo_pago SET nombre_pago='$this->nombre_pago', tipo_tabla='$this->tipo_tabla'".
			" WHERE id_pago='$this->id_pago'");

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

	function eliminarPago($id){

		$this->id_pago=$id;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM tipo_pago WHERE id_pago='$this->id_pago'");
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

	function seleccionarPago($id){

		$this->id_pago=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM tipo_pago WHERE id_pago='$this->id_pago'");
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