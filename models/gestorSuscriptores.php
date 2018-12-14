<?php

require_once "conexion.php";

class SuscriptoresModel{

	#MOSTRAR Suscriptores EN LA VISTA
	#------------------------------------------------------------
	public function mostrarSuscriptoresModel($tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("SELECT id, nombre, email FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#BORRAR Suscriptores
	#-----------------------------------------------------
	public function borrarSuscriptoresModel($datosModel, $tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

	#SELECCIONAR SUSCRIPTORES SIN REVISAR
	#------------------------------------------------------------
	public function suscriptoresSinRevisarModel($tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("SELECT revision FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetchAll();

		$stmt -> close();

	}

	#SUSCRIPTORES REVISADOS
	#------------------------------------------------------------
	public function suscriptoresRevisadosModel($datosModel, $tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("UPDATE $tabla SET revision = :revision");

		$stmt->bindParam(":revision", $datosModel, PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}

		else{

			return "error";

		}

		$stmt->close();

	}

}


