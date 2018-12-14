<?php

class SuscriptoresController{

	#MOSTRAR SUSCRIPTORES EN LA VISTA
	#------------------------------------------------------------
	public function mostrarSuscriptoresController(){
		$suscriptoresModel=new SuscriptoresModel();
		$respuesta = $suscriptoresModel->mostrarSuscriptoresModel("suscriptores");

		foreach ($respuesta as $row => $item){

			echo '<tr>
			        <td>'.$item["nombre"].'</td>
			        <td>'.$item["email"].'</td>
			        <td>
			        	<a href="index.php?action=suscriptores&idBorrar='.$item["id"].'"><span class="btn btn-danger fa fa-times quitarSuscriptor"></span></a>
			        </td>
			        <td>
			        </td>
			      </tr>';

		}

	}

	#BORRAR Suscriptores
	#------------------------------------------------------------

	public function borrarSuscriptoresController(){
		$suscriptoresModel=new SuscriptoresModel();
		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];

			$respuesta = $suscriptoresModel->borrarSuscriptoresModel($datosController, "suscriptores");

			if($respuesta == "ok"){

					echo'<script>

							swal({
								  title: "¡OK!",
								  text: "¡El suscrito se ha borrado correctamente!",
								  type: "success",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
							},

							function(isConfirm){
									 if (isConfirm) {	   
									    window.location = "suscriptores";
									  } 
							});


						</script>';

			}

		}

	}

	#IMPRESIÓN SUSCRIPTORES
	#------------------------------------------------------------

	public function impresionSuscriptoresController($datos){
		$suscriptoresModel=new SuscriptoresModel();
		$datosController = $datos;

		$respuesta = $suscriptoresModel->mostrarSuscriptoresModel($datosController);
	
		return $respuesta;

	}

	#SUSCRIPTORES SIN REVISAR
	#------------------------------------------------------------
	public function suscriptoresSinRevisarController(){
		$suscriptoresModel=new SuscriptoresModel();
		$respuesta = $suscriptoresModel->suscriptoresSinRevisarModel("suscriptores");

		$sumaRevision = 0;

		foreach ($respuesta as $row => $item) {
			
			if($item["revision"] == 0){

				++$sumaRevision;

				echo '<span>'.$sumaRevision.'</span>';

			}					
		
		}

	}

	#SUSCRIPTORES REVISADOS
	#------------------------------------------------------------
	public function suscriptoresRevisadosController($datos){
		$suscriptoresModel=new SuscriptoresModel();
		$datosController = $datos;

		$respuesta = $suscriptoresModel->suscriptoresRevisadosModel($datosController, "suscriptores");

		echo $respuesta;

	}

}