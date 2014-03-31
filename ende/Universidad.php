<?php
require_once 'Alumno.php';
class Universidad {
	private $_alumnos =array();
	public function add(Alumno $alumno) {
		$this->_alumnos[]=$alumno;
	}
	public function getAlumno($i) {
		return $this->_alumnos[$i];
	}
}
$universidad= new Universidad();
$universidad->add(new Alumno('pep',15));
$universidad->add(new Alumno('lolo',16));
$universidad->add(new Alumno('laura',17));
for($i=0; $i < 3; $i++) {

$a1 = $universidad->getAlumno($i);
//$a1 = new Alumno();
echo $a1->getNombre() . '<br>';

echo $universidad->getAlumno($i)->getNombre() .' - ';
//$a1 = new Alumno();
echo $a1->getNombre() . '<br>';

}
?>