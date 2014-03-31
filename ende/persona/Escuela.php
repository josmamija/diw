<?php
require_once 'Persona.php';
class Escuela {
	private $_nombre;
	private $_alumnos =  array();
	public function __construct($nombre) {
		$this->_nombre=$nombre;
	}

	public function addAlumno (Persona $persona) {
	$this->_alumnos[] = $persona;
	//echo $_alumnos[0];
	}

	public function dameNombre () {
	return $this->_nombre;
	//echo $_alumnos[0];
	}
	public function getAlumno($i) {
		return $this->_alumnos[$i];
	}
	public function __toString() {
		$retorno ='Escuela :' .$this->_nombre .'<br>';
		foreach ($this->_alumnos as $alumno){
			$retorno .= $alumno .'<br>';
		}
		return $retorno;
	}
}
/*
$escuela= new Escuela('brosa');
$escuela->addAlumno(new Persona('pepe',12));
echo $escuela;
echo $escuela->dameNombre();
*/
?>