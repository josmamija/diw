<?php
require_once 'Empresa.php';
require_once 'Persona.php';
require_once 'Respuesta.php';


abstract class Index {
	public function run() {

		$empresa = new Empresa();
		$persona = new Persona ('masculino');
		/* Defino la Encuesta en base al sexo */
		$sexo = $persona->getSexo();
		$encuesta= $empresa->getEncuesta($sexo);

		/* Martina, dueña del mismo perro... */
		$persona->setEncuesta($encuesta);
		$preguntas= $encuesta->getPreguntas();

	
		/* Respondo las preguntas de la encuesta */
		foreach($preguntas as $pregunta){
			echo $pregunta."<br>";
			$persona->addRespuesta(new Respuesta($pregunta,"si"));
		}
		/*Puedo Preguntarle a la Persona sus respuestas */

		echo $persona->getResumenPreguntasRespuestasRespondidas();

		/*Si la empresa tuviera muchas personas seria el proceso similar al caso anterior, solo que*/
		/*la empresa recorre todas las personas encuestas de una empresa determinada */
		
	}
}


Index::run();
