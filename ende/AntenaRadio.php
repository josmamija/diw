<?php
class AntenaRadio {
	private $_longitud;
	public function __construct($longitud) {
		$this->_longitud =$longitud;
		
	}
	public function getLongitud(){
		return $this->_longitud;
	}
	
}
//$alumno = new Alumno("pep",14);
//echo $alumno->getNombre();
?>