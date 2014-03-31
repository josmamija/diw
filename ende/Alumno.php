<?php
class Alumno {
	private $_nombre;
	private $_edad;
	public function __construct($nombre, $edad) {
		$this->_nombre =$nombre;
		$this->_edad=$edad;
	}
	public function getNombre (){
		return $this->_nombre;
	}
	
}
//$alumno = new Alumno("pep",14);
//echo $alumno->getNombre();
?>