<?php

class Enlaces{

	public function enlacesController(){

		if(isset($_GET["action"])){

			$enlaces = $_GET["action"];

		}

		else{

			$enlaces = "index";
		}
		$enlacesModels=new EnlacesModels();
		$respuesta = $enlacesModels->enlacesModel($enlaces);

		include $respuesta;

	}


}