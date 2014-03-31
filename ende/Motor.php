<?php
class Motor {
	private $_tipo;
	private $_cilindrada;
	public function __construct($cilindrada,$tipo) {
		$this->_tipo =$tipo;
		$this->_cilindrada=$cilindrada;
	}
	public function getCilindrada (){
		return $this->_cilindrada;
	}
	public function getTipo(){
		return $this->_tipo;
	}
	
}
//$alumno = new Alumno("pep",14);
//echo $alumno->getNombre();
?>