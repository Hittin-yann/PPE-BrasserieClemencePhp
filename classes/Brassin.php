<?php
class Brassin{

	private $code;
	private $dateBrass;
	private $dateMiseBout;
	private $volume;
	private $pourAlcool;
	private $nomCom;

	//CONSTRUCTEUR
	public function __construct(){
	}

	//GETTERS ET SETTERS
	public function getCode(){
		return $this->code;
	}

	public function getDateBrass(){
		return $this->dateBrass;
	}

	public function getDateMiseBout(){
		return $this->dateMiseBout;
	}

	public function getVolume(){
		return $this->volume;
	}

	public function getPourAlcool(){
		return $this->pourAlcool;
	}

	public function getNomCom(){
		return $this->nomCom;
	}

	public function setCode($c){
		$this->code = $c;
	}

	public function setDateBrass($d){
		$this->dateBrass = $d;
	}

	public function setDateMiseBout($d){
		$this->dateMiseBout = $d;
	}

	public function setVolume($v){
		$this->volume = $v;
	}

	public function setPourAlcool($a){
		$this->pourAlcool = $a;
	}

	public function setNomCom($c){
		$this->nomCom = $c;
	}
}
?>