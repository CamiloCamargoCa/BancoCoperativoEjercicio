<?php


include 'Conexion.php';

 class Credito{

 	private $id_cre;
 	private $id_usu;
 	private $id_cli;
 	private $id_pla;
 	private $id_am;
 	private $id_tipo_cre;
 	private $id_pago;
 	private $tasa_nominal;
 	private $tasa_eanual;
 	private $tasa_periodica;
 	private $monto;
 	private $n_periodos;
 	private $fecha_pago;
 	private $idTipoCredito;
	

	function registrarCredito($id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago){

		$this->$id_usu=$id_usu;
	 	$this->$id_cli=$id_cli;
	 	$this->$id_pla=$id_pla;
	 	$this->$id_am=$id_am;
	 	$this->$id_tipo_cre=$id_tipo_cre;
	 	$this->$id_pago=$id_pago;
	 	$this->$tasa_nominal=$tasa_nominal;
	 	$this->$tasa_eanual=$tasa_eanual;
	 	$this->$tasa_periodica=$tasa_periodica;
	 	$this->$monto=$monto;
	 	$this->$n_periodos=$n_periodos;
	 	$this->$fecha_pago=$fecha_pago;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO Credito (id_usu, id_cli, id_pla, id_am, id_tipo_cre, id_pago, tasa_nominal, tasa_eanual, tasa_periodica, monto, n_periodos, fecha_pago) VALUES ('$this->id_usu','$this->id_cli','$this->id_pla','$this->id_am','$this->id_tipo_cre','$this->id_pago','$this->tasa_nominal','$this->tasa_eanual','$this->tasa_periodica','$this->monto','$this->n_periodos','$this->fecha_pago')");
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

	function editarCredito($id_cre,$id_usu,$id_cli,$id_pla,$id_am,$id_tipo_cre,$id_pago,$tasa_nominal,$tasa_eanual,$tasa_periodica,$monto,$n_periodos,$fecha_pago){

		$this->$id_cre=$id_cre;
		$this->$id_usu=$id_usu;
	 	$this->$id_cli=$id_cli;
	 	$this->$id_pla=$id_pla;
	 	$this->$id_am=$id_am;
	 	$this->$id_tipo_cre=$id_tipo_cre;
	 	$this->$id_pago=$id_pago;
	 	$this->$tasa_nominal=$tasa_nominal;
	 	$this->$tasa_eanual=$tasa_eanual;
	 	$this->$tasa_periodica=$tasa_periodica;
	 	$this->$monto=$monto;
	 	$this->$n_periodos=$n_periodos;
	 	$this->$fecha_pago=$fecha_pago;

		$conx = new Conexion();

		$res=$conx->prepare("UPDATE Credito SET nombre='$this->nombre' ,tiempo='$this->tiempo' ,valor='$this->valor', tipo_credito='$this->tipo_credito'".
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

	function eliminarCredito($id){

		$this->id_am=$id;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM Credito WHERE id_cre='$this->id_cre'");
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

	function listarCredito(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM Credito");
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

	function seleccionarCredito($id){

		$this->id_am=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM Credito WHERE id_cre='$this->id_cre'");
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


	function listarAmortizacion($idTipoCredito){

		$conx = new Conexion();

		$this->idTipoCredito=$idTipoCredito;

		$res=$conx->prepare("SELECT * FROM `amortizacion` am inner join tipo_credito tcre on am.tipo_credito = tcre.id_tipo_cre WHERE tcre.id_tipo_cre='$this->idTipoCredito'");
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

	function listarPlazo($idTipoCredito){

		$conx = new Conexion();

		$this->idTipoCredito=$idTipoCredito;

		$res=$conx->prepare("SELECT * FROM `plazos` pla inner join tipo_credito tcre on pla.tipo_credito = tcre.id_tipo_cre WHERE tcre.id_tipo_cre='$this->idTipoCredito'");
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