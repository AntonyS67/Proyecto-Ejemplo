<?php

require_once "conexion.php";

class IngresoModels{

	public function ingresoModel($datosModel, $tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("SELECT id, usuario, password, email, photo, rol, intentos FROM $tabla WHERE usuario = :usuario");

		$stmt -> bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		
		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

	}

	public function intentosModel($datosModel, $tabla){
		$con=new Conexion();
		$stmt = $con->conectar()->prepare("UPDATE $tabla SET intentos = :intentos WHERE usuario = :usuario");

		$stmt -> bindParam(":intentos", $datosModel["actualizarIntentos"], PDO::PARAM_INT);
		$stmt -> bindParam(":usuario", $datosModel["usuarioActual"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}

		else{

			return "error";
		}

	}

}