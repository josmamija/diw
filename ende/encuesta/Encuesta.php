<?php
require_once 'Pregunta.php';

class Encuesta {
	private $_nombre;
	private $_colPreguntas =  array();

	public function __construct($nombre) {
		$this->_nombre=$nombre;	
	}

	public function addPregunta ($texto) {
		$this->_colPreguntas[] = new Pregunta($texto);
	}

	public function __toString(){
		return $this->_nombre;

	}
	public function getNombre() {
		return $this->_nombre;
	}
	public function getPreguntas() {
		return $this->_colPreguntas;
		
	}
}
/*
$e = new Encuesta("datos personales");
echo $e ."<br";
$e->addPregunta("Como te llamas'");
$e->addPregunta("Telefono?");
$pre=$e->getPreguntas();
foreach($pre as $pregunta){
	//echo $pregunta .' hola ';
	echo "hola";
}
*/
?>