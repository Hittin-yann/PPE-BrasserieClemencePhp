<?php
class Mouvement{

	private $id;
	private $date;
	private $contenance;
	private $nbBouteilles;
	private $code;
	private $stockDebMois;
	private $stockRealise;
	private $sortiesVendues;
	private $sortiesDeg;
	private $stockFinMois;
	private $volSorties;
	private $coutDouanes;
	// ajout ED
	private $nomCommercial;
	private $pourcentageAlcool;
	
	// fin ajout ED

	//CONSTRUCTEUR
	public function __construct(){
	}

	//GETTERS ET SETTERS
	public function getId(){
		return $this->id;
	}

	public function getDate(){
		return $this->date;
	}

	public function getContenance(){
		return $this->contenance;
	}

	public function getNbBouteilles(){
		return $this->nbBouteilles;
	}

	public function getCode(){
		return $this->code;
	}

	public function getStockDebMois(){
		return $this->stockDebMois;
	}

	public function getStockRealise(){
		return $this->stockRealise;
	}

	public function getSortiesVendues(){
		return $this->sortiesVendues;
	}

	public function getSortiesDeg(){
		return $this->sortiesDeg;
	}

	public function getStockFinMois(){
		return $this->stockFinMois;
	}

	public function getVolSorties(){
		return $this->volSorties;
	}

	public function getCoutDouanes(){
		return $this->coutDouanes;
	}
	
	public function getNomCommercial(){
		return $this->nomCommercial;
	}
	
	public function getPourcentageAlcool(){
		return $this->pourcentageAlcool;
	}

	public function setId($i){
		$this->id = $i;
	}

	public function setDate($d){
		$this->date = $d;
	}

	public function setContenance($c){
		$this->contenance = $c;
	}

	public function setNbBouteilles($b){
		$this->nbBouteilles = $b;
	}

	public function setCode($c){
		$this->code = $c;
	}

	public function setStockDebMois($d){
		$this->stockDebMois = $d;
	}

	public function setStockRealise($r){
		$this->stockRealise = $r;
	}

	public function setSortiesVendues($v){
		$this->sortiesVendues = $v;
	}

	public function setSortiesDeg($d){
		$this->sortiesDeg = $d;
	}

	public function setStockFinMois($m){
		$this->stockFinMois = $m;
	}

	public function setVolSorties($s){
		$this->volSorties = $s;
	}

	public function setCoutDouanes($d){
		$this->coutDouanes = $d;
	}
	
	public function setNomCommercial($n){
		$this->nomCommercial = $n;
	}

	public function setPourcentageAlcool($p){
		$this->pourcentageAlcool = $p;
	}
}
?>