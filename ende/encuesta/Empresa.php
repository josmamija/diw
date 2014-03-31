<?php
require_once 'Persona.php';
require_once 'Encuesta.php';
class Empresa {
	private $_colPersonas = array();
	private $_colEncuestas =  array();
	public function __construct($nombre) {
		$encuesta = new Encuesta('masculino');
		$encuesta->addPregunta("Tienes conocimientos de POO?");
		$encuesta->addPregunta("Tienes conocimientos de Base de Datos?");
		$this->_colEncuentas[]=$encuesta;	
	}

	public function addPersona (Persona $persona) {
		$this->_colPersonas[] = $persona;
	}

	public function addEncuesta(Encuesta $encuesta) {
		return $this->_nombre;
		$this->_colEncuestas($encuesta);

	}

	public function getEncuesta($nombre) {
		
		foreach ($this->_colEncuestas as $encuesta){
			if($encuesta->getNombre() == $nombre) {
				return $encuesta;
			}
			
		}
		
	}
}
/*
$escuela= new Escuela('brosa');
$escuela->addAlumno(new Persona('pepe',12));
echo $escuela;
echo $escuela->dameNombre();
*/
?>