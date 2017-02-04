<?php
require_once("model/animal.php");
class AnimalController {
	
	private $animais;

	public function startAnimais(){
		$this->createAnimal('água', 'Tubarão');
		$this->createAnimal('outro', 'Macaco');
	}

	public function createAnimal($tipo, $especie){
		$a = new Animal;
        $a->setTipo($tipo);
        $a->setEspecie($especie);

        $this->addAnimal($tipo, $a);
	}

	public function addAnimal($tipo, $animal){
		if($tipo == 'água'){
			$this->animais['agua'][] = $animal;
		}else{
			$this->animais['outros'][] = $animal;
		}
	}	

	public function getAnimais(){
		return $this->animais;
	}

	public function getModais(){
		$arrayAnimais = $this->getAnimais();
		$add = '';

		foreach ($arrayAnimais as $i => $array) {
    		$arrayInvertido  = array_reverse($array);
    		foreach ($arrayInvertido as $j => $animal) {

				$add .= '<div id="'.$j. $i.'" class="modal fade" role="dialog">'.
		            '<div class="modal-dialog">'.
		                '<div class="modal-content">'.
		                    '<div class="modal-header">'.
		                        '<button type="button" class="close" data-dismiss="modal">&times;</button>'.
		                        '<h4 class="modal-title"> Jogo Dos Animais </h4>'.
		                    '</div>'.

		                    '<div class="modal-body">'.
		                        '<p> O animal que você pensou é um(a) '.$animal->especie.'</p>'.
		                    '</div>'.

		                    '<div class="modal-footer">'.
		                     '<button id="btnSim'.$animal->especie.'" type="button" class="btn btn-default" data-dismiss="modal">Sim</button>'.
		                     '<button id="btnNao'.$animal->especie.'" type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#'.($j+1).$i.'">Não</button>'.
		                    '</div>'.
		                '</div>'.
		            '</div>'.
		        '</div>';
		    }
		}

		return $add;
	}
}
?>