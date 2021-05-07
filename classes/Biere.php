<?php
class Biere{

	private $id;
	private $nom;

	//CONSTRUCTEUR
	public function __construct(){
	}

	//GETTERS ET SETTERS
	public function getId(){
		return $this->id;
	}

	public function getNom(){
		return $this->nom;
	}

	public function setId($i){
		$this->id = $i;
	}

	public function setNom($n){
		$this->nom = $n;
	}

}
?>