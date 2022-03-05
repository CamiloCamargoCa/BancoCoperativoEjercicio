<?php


include 'Conexion.php';

 class Amortizacion{

 	private $id_am;
 	private $nombre;
 	private $tiempo;
 	private $valor;
 	private $tipo_credito;
	

	function registrarAmortizacion($nombre,$tiempo,$valor,$tipo_credito){

		$this->nombre=$nombre;
		$this->tiempo=$tiempo;
		$this->valor=$valor;
		$this->tipo_credito=$tipo_credito;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO amortizacion (nombre,tiempo,valor,tipo_credito) VALUES ('$this->nombre','$this->tiempo','$this->valor','$this->tipo_credito')");
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

	function editarAmortizacion($id,$nombre,$tiempo,$valor,$tipo_credito){

		$this->id_am=$id;
		$this->nombre=$nombre;
		$this->tiempo=$tiempo;
		$this->valor=$valor;
		$this->tipo_credito=$tipo_credito;

		$conx = new Conexion();

		$res=$conx->prepare("UPDATE amortizacion SET nombre='$this->nombre' ,tiempo='$this->tiempo' ,valor='$this->valor', tipo_credito='$this->tipo_credito'".
			" WHERE id_am='$this->id_am'");

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

	function eliminarAmortizacion($id){

		$this->id_am=$id;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM amortizacion WHERE id_am='$this->id_am'");
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

	function listarAmortizacion(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM `amortizacion` am inner join tipo_credito tcre on am.tipo_credito = tcre.id_tipo_cre");
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

	function seleccionarAmortizacion($id){

		$this->id_am=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM amortizacion WHERE id_am='$this->id_am'");
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

	function listarTipoCredito(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM tipo_credito");
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