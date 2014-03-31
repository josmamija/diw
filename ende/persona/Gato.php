<?php
class Gato
{
	private $_color;
	private $_nombre;
	private $_estomagoLleno = false;
	public function __construct($nombre, $color)
	{
		$this->_nombre = $nombre;
		$this->_color = $color;
	}
	public function tirarCola()
	{
		return $this->moverLaCola();
	}
	public function moverLaCola()
	{
		return 'estoy estirando la cola!';
	}
	public function comer()
	{
		$this->_estomagoLleno = true;
		sleep(5);
		return $this->_hacerDigestion();
	}
	public function hacerNecesidades()
	{
		return 'hago caca!';
	}
	private function _hacerDigestion()
	{
		$retorno = null;
		if($this->_estomagoLleno){
			$this->_estomagoLleno = false;
			$retorno = $this->hacerNecesidades();
		}
	return $retorno;
	}
}
