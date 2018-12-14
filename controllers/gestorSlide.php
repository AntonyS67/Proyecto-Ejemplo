<?php

class GestorSlide{

	#MOSTRAR IMAGEN SLIDE AJAX
	#------------------------------------------------------------

	public function mostrarImagenController($datos){

		#getimagesize - Obtiene el tamaño de una imagen

		#LIST(): Al igual que array(), no es realmente una función, es un constructor del lenguaje. list() se utiliza para asignar una lista de variables en una sola operación.

		list($ancho, $alto) = getimagesize($datos["imagenTemporal"]);
		
		if($ancho < 1600 || $alto < 600){

			echo 0;

		}

		else{

			$aleatorio = mt_rand(100, 999);

			$ruta = "../../views/images/slide/slide".$aleatorio.".jpg";

			#imagecreatefromjpeg — Crea una nueva imagen a partir de un fichero o de una URL

			$origen = imagecreatefromjpeg($datos["imagenTemporal"]);

			#imagecrop() — Recorta una imagen usando las coordenadas, el tamaño, x, y, ancho y alto dados

			$destino = imagecrop($origen, ["x"=>0, "y"=>0, "width"=>1600, "height"=>600]);

			#imagejpeg() — Exportar la imagen al navegador o a un fichero

			imagejpeg($destino, $ruta);
			$gestorSlideModel=new GestorSlideModel();
			$gestorSlideModel->subirImagenSlideModel($ruta, "slide");

			$respuesta = $gestorSlideModel->mostrarImagenSlideModel($ruta, "slide");

			$enviarDatos = array("ruta"=>$respuesta["ruta"],
				                 "titulo"=>$respuesta["titulo"],
				                 "descripcion"=>$respuesta["descripcion"]);

			echo json_encode($enviarDatos);
		}

	}

	#MOSTRAR IMAGENES EN LA VISTA
	#------------------------------------------------------------

	public function mostrarImagenVistaController(){
		$gestorSlideModel=new GestorSlideModel();
		$respuesta = $gestorSlideModel->mostrarImagenVistaModel("slide");

		foreach($respuesta as $row => $item){

			echo '<li id="'.$item["id"].'" class="bloqueSlide"><span class="fa fa-times eliminarSlide" ruta="'.$item["ruta"].'"></span><img src="'.substr($item["ruta"], 6).'" class="handleImg"></li>';

		}

	}

	#MOSTRAR IMAGENES EN EL EDITOR
	#------------------------------------------------------------

	public function editorSlideController(){
		$gestorSlideModel=new GestorSlideModel();
		$respuesta = $gestorSlideModel->mostrarImagenVistaModel("slide");

		foreach($respuesta as $row => $item){

			echo '<li id="item'.$item["id"].'">
					<span class="fa fa-pencil editarSlide" style="background:blue"></span>
					<img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
					<h1>'.$item["titulo"].'</h1>
					<p>'.$item["descripcion"].'</p>
				</li>';

		}

	}

	#ELIMINAR ITEM DEL SLIDE
	#-----------------------------------------------------------
	public function eliminarSlideController($datos){
		$gestorSlideModel=new GestorSlideModel();
		$respuesta = $gestorSlideModel->eliminarSlideModel($datos, "slide");

		unlink($datos["rutaSlide"]);

		echo $respuesta;

	}

	#ACTUALIZAR ITEM DEL SLIDE
	#-----------------------------------------------------------

	public function actualizarSlideController($datos){
		$gestorSlideModel=new GestorSlideModel();
		$gestorSlideModel->actualizarSlideModel($datos, "slide");
		$respuesta =$gestorSlideModel->seleccionarActualizacionSlideModel($datos, "slide");

		$enviarDatos = array("titulo"=>$respuesta["titulo"],
			                 "descripcion"=>$respuesta["descripcion"]);
		
		echo json_encode($enviarDatos);
	}

	#ACTUALIZAR ORDEN 
	#---------------------------------------------------
	public function actualizarOrdenController($datos){
		$gestorSlideModel=new GestorSlideModel();
		$gestorSlideModel->actualizarOrdenModel($datos, "slide");

		$respuesta = $gestorSlideModel->seleccionarOrdenModel("slide");

		foreach($respuesta as $row => $item){

			echo'<li id="item'.$item["id"].'">
			     <span class="fa fa-pencil editarSlide" style="background:blue"></span>
			     <img src="'.substr($item["ruta"], 6).'" style="float:left; margin-bottom:10px" width="80%">
			     <h1>'.$item["titulo"].'</h1>
			     <p>'.$item["descripcion"].'</p>
			     </li>';

		}




	}

}