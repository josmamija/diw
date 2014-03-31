<?php

class Persona
{
	private $_edad;
	private $_nombre;
	private $_perro;
	private $_gato;
	public function __construct($nombre, $edad)
	{
		$this->_nombre = $nombre;
		$this->_edad = $edad;
	}
	public function getNombre(){
		return  $this->$_nombre;
	}
	
	public function __toString()
 	{ 
		return $this->_nombre . ' ' .$this->_edad;
	}
	
	public function setPerro(Perro $perro){
		$this->_perro=$perro;
	}
	public function getPerro(){
		return $this->_perro;
	}
	public function setGato(Gato $gato){
		$this->_gato=$gato;
	}
	public function getGato(){
		return $this->_gato;
	}
	public function darCariciaPerro(Perro $perro)
	{
		echo $perro->recibirCariciaCabeza() . '<br>';
	}
	/*
	public function darDeComerPerro($perro)
	{
		echo $perro->comer() . '<br>';
	}
	
	
	*/
	public function darComer(Perro $perro)
	{
		echo $perro->comer() . '<br>';
	}
	
	public function darComerG(Gato $gato)
	{
		echo $gato->comer() . '<br>';
	}
	
	public function tocar(Perro $perro)
	{
		echo $perro->recibirCariciaCabeza() . '<br>';
	}
	public function tocarG(Gato $gato)
	{
		echo $gato->tirarCola() . '<br>';
	}
}

?>
