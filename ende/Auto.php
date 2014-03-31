<?php
require_once 'Motor.php';
require_once 'TanqueCombustible.php';
require_once 'AntenaRadio.php';
class Auto {
	private $_motor;
	private $_tanqueCombustible; 
	private $_antenaRadio;
	public function __construct() {
		$this->_motor = new Motor(2000,'Diesel');
		$this->_tanqueCombustible = new TanqueCombustible(50); 
		$this->_antenaRadio = new AntenaRadio(75);
		
	}
	public function mostrarAuto(){		
		echo $this->_motor->getTipo() . ' - ' . $this->_motor->getCilindrada();
		echo '<br>';
		echo 'Deposito: ' .$this->_tanqueCombustible->getVolumen() . '<br>';
		echo 'Antena: '. $this->_antenaRadio->getLongitud();
	
		
	}
	
}
$auto = new Auto();
$auto->mostrarAuto();
?>