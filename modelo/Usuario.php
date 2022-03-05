<?php


include 'Conexion.php';

 class Usuario{

 	private $id_usu;
	private $alias;
	private $usuario;
	private $contrasena;
	

	function registrarUsuario($alias,$usuario,$contrasena){

		$this->alias=$alias;
		$this->usuario=$usuario;
		$this->contrasena=$contrasena;

		$conx = new Conexion();

		$res=$conx->prepare("INSERT INTO usuario (alias, usuario, contrasena) VALUES ('$this->alias','$this->usuario','$this->contrasena')");
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

	function editarUsuario($id_usu,$alias,$usuario,$contrasena){

		$this->id_usu=$id_usu;
		$this->alias=$alias;
		$this->usuario=$usuario;
		$this->contrasena=$contrasena;

		$conx = new Conexion();

		$res=$conx->prepare("update usuario set alias='$this->alias', usuario='$this->usuario', contrasena='$this->contrasena' ".
			" where id_usu='$this->id_usu'");

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

	function eliminarUsuario($id_usu){

		$this->id_usu=$id_usu;

		$conx = new Conexion();

		$res=$conx->prepare("DELETE FROM usuario WHERE id_usu='$this->id_usu'");
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

	function listarUsuario(){

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM usuario");
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

	function seleccionarUsuario($id){

		$this->id_usu=$id;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM usuario WHERE id_usu='$this->id_usu'");
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


	function loginUsuario($usu,$pass){

		$this->usuario=$usu;
		$this->contrasena=$pass;

		$conx = new Conexion();

		$res=$conx->prepare("SELECT * FROM usuario WHERE usuario='$this->usuario' AND contrasena='$this->contrasena'");
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