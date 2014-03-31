<?php
class TanqueCombustible {
	private $_volumen;
	public function __construct($volumen) {
		$this->_volumen =$volumen;
		
	}
	public function getVolumen(){
		return $this->_volumen;
	}
	
}
//$alumno = new Alumno("pep",14);
//echo $alumno->getNombre();
?>