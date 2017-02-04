<?php
class Animal {
	
	public $tipo;

	public $especie;

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}	

	public function setEspecie($especie){
		$this->especie = $especie;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function getEspecie(){
		return $this->especie;
	}
}

?>