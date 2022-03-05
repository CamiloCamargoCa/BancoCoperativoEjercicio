<?php


include 'Conexion.php';

 class Plazo{

 	private $id_pla;
 	private $tiempo;
 	private $valor;
 	private $tipo_credito;
	
	

	function registrarPlazo($tiempo,$valor,$tipo_credito){

		$this->tiempo=$tiempo;
		$this->valor=$valor;
		$this->tipo_credito=$tipo_credito;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO plazos (tiempo,valor,tipo_credito) VALUES ('$this->tiempo','$this->valor','$this->tipo_credito')");
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

	function editarPlazo($id,$tiempo,$valor,$tipo_credito){

		$this->id_pla=$id;
		$this->tiempo=$tiempo;
		$this->valor=$valor;
		$this->tipo_credito=$tipo_credito;

		$conx = new Conexion();

		$res=$conx->prepare("UPDATE plazos SET tiempo='$this->tiempo' ,valor='$this->valor', tipo_credito='$this->tipo_credito'".
			" WHERE id_pla='$this->id_pla'");

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

	function eliminarPlazo($id){

		$this->id_pla=$id;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM plazos WHERE id_pla='$this->id_pla'");
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

	function listarPlazo(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM `plazos` pla inner join tipo_credito tcre on pla.tipo_credito = tcre.id_tipo_cre");
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

	function seleccionarPlazo($id){

		$this->id_pla=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM plazos WHERE id_pla='$this->id_pla'");
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