<?php
class BDD{

	private static $serveur="mysql:host=127.0.0.1";
	private static $bdd="dbname=brasserie";
	private static $user="clemence";
	private static $mdp="clemence";
	private $laConnexion;

	//
	//CONSTRUCTEUR
	//
	public function __construct()
	{
    	$this->laConnexion = new PDO(BDD::$serveur.';'.BDD::$bdd, BDD::$user, BDD::$mdp); 
		$this->laConnexion->query("SET CHARACTER SET utf8");
	}
	public function _destruct(){
		$this->laConnexion = null;
	}


	//
	//GETTERS ET SETTERS POUR CHAQUE TABLEAUX
	//
	public function getBiere(){
		$req='select * from biere';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$b = new Biere();
			$b->setId($line[0]);
			$b->setNom($line[1]);

			$tableau[] = $b;
		}
		return $tableau;
		//retourne un tableau avec toute les bières
	}


	public function getBrassin(){
		$req='select * from brassin inner join biere on brassin.id = biere.id';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$br = new Brassin();
			$br->setCode($line[0]);
			$br->setDateBrass($line[1]);
			$br->setDateMiseBout($line[2]);
			$br->setVolume($line[3]);
			$br->setPourAlcool($line[5]);
			$br->setNomCom($line[7]);

			$tableau[] = $br;
		}
		return $tableau;
		//retourne un tableau avec tout les brassins
	}


	public function getBrassinMois($date1, $date2)
	{
		$req='select * from brassin inner join biere on brassin.id = biere.id where dateBrass between "'.$date1.'" and "'.$date2.'";';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$br = new Brassin();
			$br->setCode($line[0]);
			$br->setDateBrass($line[1]);
			$br->setDateMiseBout($line[2]);
			$br->setVolume($line[3]);
			$br->setPourAlcool($line[5]);
			$br->setNomCom($line[7]);

			$tableau[] = $br;
		}
		return $tableau;
		//retourne un tableau avec tout les brassins en fonction de l'intervalle de date choisi
	}


	public function getBiereBrassin($id)
	{
		$req='select * from biere where id="'.$id.'";';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$b = new Biere();
			$b->setId($line[0]);
			$b->setNom($line[1]);

			$tableau[] = $b;
		}
		return $tableau;
		//retourne un tableau avec toute les bières
	}


	
	public function getMouvementBrassin($code)
	{
		// ED modification de la requête avec jointure sur brassin
		$req='select * from mouvement inner join brassin on brassin.code = mouvement.code inner join biere on brassin.id = biere.id where mouvement.code="'.$code.'";';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$m = new Mouvement();
			$m->setId($line[0]);
			$m->setDate($line[1]);
			$m->setContenance($line[2]);
			$m->setNbBouteilles($line[3]);
			$m->setCode($line[4]);
			$m->setStockDebMois($line[5]);
			$m->setStockRealise($line[6]);
			$m->setSortiesVendues($line[7]);
			$m->setSortiesDeg($line[8]);
			$m->setStockFinMois($line[9]);
			$m->setVolSorties($line[10]);
			$m->setCoutDouanes($line[11]);
			// Ajout des champs 17 et 19
			$m->setPourcentageAlcool($line[17]);
			$m->setNomCommercial($line[19]);
			$tableau[] = $m;
		}
		return $tableau;
		//retourne un tableau avec tout les mouvements
	}


	public function getMouvement(){
		// Changement requête ajout des jointures
		$req='select * from mouvement inner join brassin on brassin.code = mouvement.code inner join biere on brassin.id = biere.id';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$tableau = array();

		foreach ($lesLignes as $line){
			$m = new Mouvement();
			$m->setId($line[0]);
			$m->setDate($line[1]);
			$m->setContenance($line[2]);
			$m->setNbBouteilles($line[3]);
			$m->setCode($line[4]);
			$m->setStockDebMois($line[5]);
			$m->setStockRealise($line[6]);
			$m->setSortiesVendues($line[7]);
			$m->setSortiesDeg($line[8]);
			$m->setStockFinMois($line[9]);
			$m->setVolSorties($line[10]);
			$m->setCoutDouanes($line[11]);
			// Ajout des champs 17 et 19
			$m->setPourcentageAlcool($line[17]);
			$m->setNomCommercial($line[19]);
			
			$tableau[] = $m;
		}
		return $tableau;
		//retourne un tableau avec tout les mouvements
	}


	//
	//FONCTIONS D'AJOUT
	//
	public function insertBiere($uneBiere){
		//insert une nouvelle bière dans la base de données
		$req='insert into biere (nom) values ("'.$uneBiere->getNom().'");';
		$this->laConnexion->exec($req);
	}


	public function insertBrassin($unBrassin, $id){
		//insert un nouveau brassin dans la base de données
		$req='insert into brassin (code, dateBrass, dateMiseBout, volume, pourAlcool, id) values ("'.$unBrassin->getCode().'", "'.$unBrassin->getDateBrass().'", "'.$unBrassin->getDateMiseBout().'", '.$unBrassin->getVolume().', '.$unBrassin->getPourAlcool().', '.$id.');';
		$this->laConnexion->exec($req);
	}


	public function insertMouvement($unMouvement){
		//insert un nouveau mouvement dans la base de données
		$req='insert into mouvement (date, contenance, nbBouteilles, code, stockDebMois, stockRealise, sortiesVendues, sortiesDeg, stockFinMois, volSorties, coutDouanes) values ("'.$unMouvement->getDate().'",'.$unMouvement->getContenance().', '.$unMouvement->getNbBouteilles().', "'.$unMouvement->getCode().'", '.$unMouvement->getStockDebMois().', '.$unMouvement->getStockRealise().', '.$unMouvement->getSortiesVendues().', '.$unMouvement->getSortiesDeg().', '.$unMouvement->getStockFinMois().', '.$unMouvement->getVolSorties().', '.$unMouvement->getCoutDouanes().');';
		echo $req;
		$this->laConnexion->exec($req);
	}


	//
	//FONCTIONS DE RECUPERATION
	//
	public function recupBrassin($code){
		//permet de récupérer un brassin pour pouvoir le modifier dans la fonction update
		$req='select * from brassin inner join biere on brassin.id = biere.id where code="'.$code.'";';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$val=$lesLignes[0];

		$b = new Brassin();
		$b->setCode($val[0]);
		$b->setDateBrass($val[1]);
		$b->setDateMiseBout($val[2]);
		$b->setVolume($val[3]);
		$b->setPourAlcool($val[5]);
		$b->setNomCom($val[7]);

		return $b;
	}


	public function recupMouvement($id){
		//permet de récupérer un mouvement pour pouvoir le modifier dans la fonction update
		$req='select * from mouvement where mouvement.id='.$id.';';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$val=$lesLignes[0];

		$m = new Mouvement();
			$m->setId($val[0]);
			$m->setDate($val[1]);
			$m->setContenance($val[2]);
			$m->setNbBouteilles($val[3]);
			$m->setCode($val[4]);
			$m->setStockDebMois($val[5]);
			$m->setStockRealise($val[6]);
			$m->setSortiesVendues($val[7]);
			$m->setSortiesDeg($val[8]);
			$m->setStockFinMois($val[9]);
			$m->setVolSorties($val[10]);
			$m->setCoutDouanes($val[11]);

		return $m;
	}

	//
	//FONCTIONS DE MISE A JOUR
	//
	public function updateBiere($uneBiere){
		//met à jour une bière dans la base de données
		$req='update biere set nom="'.$uneBiere->getNom().'" where id='.$uneBiere->getId().';';
		$this->laConnexion->exec($req);
	}


	public function updateBrassin($unBrassin, $id){
		//met à jour un brassin dans la base de données
		$req='update brassin set dateBrass="'.$unBrassin->getDateBrass().'", dateMiseBout="'.$unBrassin->getDateMiseBout().'", volume="'.$unBrassin->getVolume().'", pourAlcool='.$unBrassin->getPourAlcool().', id='.$id.' where code="'.$unBrassin->getCode().'";';
		$this->laConnexion->exec($req);
	}


	public function updateMouvement($unMouvement){
		//met à jour un mouvement dans la base de données
		$req='update mouvement set date="'.$unMouvement->getDate().'", contenance='.$unMouvement->getContenance().', nbBouteilles='.$unMouvement->getNbBouteilles().', stockDebMois='.$unMouvement->getStockDebMois().', stockRealise='.$unMouvement->getStockRealise().', sortiesVendues='.$unMouvement->getSortiesVendues().', sortiesDeg='.$unMouvement->getSortiesDeg().', stockFinMois='.$unMouvement->getStockFinMois().', volSorties='.$unMouvement->getVolSorties().', coutDouanes='.$unMouvement->getCoutDouanes().' where id='.$unMouvement->getId().';';
		$this->laConnexion->exec($req);
	}

	//
	//FONCTION DE SUPPRESSION
	//
	public function deleteBiere($id){
		//supprime une bière de la base de données
		$req='delete from biere where id='.$id.';';
		$this->laConnexion->exec($req);
	}


	public function deleteBrassin($code){
		//supprime un brassin de la base de données
		$req='delete from mouvement where code="'.$code.'"; delete from brassin where code="'.$code.'";';
		$this->laConnexion->exec($req);
	}


	public function deleteMouvement($id){
		//supprime un mouvement de la base de données
		$req='delete from mouvement where id='.$id.';';
		$this->laConnexion->exec($req);
	}


	//
	//FONCTION DE CONNEXION
	//
	public function connexion($log, $mdp){
		//envoie une requête pour faire correspondre un id et un mdp avec un count
		$req='select count(*) as truc from user where log="'.$log.'" AND mdp="'.$mdp.'";';
		$res=$this->laConnexion->query($req);
		$lesLignes=$res->fetchAll();
		$val = $lesLignes[0];
		$val2 = $val[0];
		return $val2;
	}

	//
	//FONCTION DE CREATION D'IDENTIFIANT
	//
	public function creaIDBrassin($date){
		//fonction qui permet de créer un code en retournant le nombre de lignes existant dans la table brassin pour créer un numero, ainsi qu'avec la date et la lettre B, soit "B00117062020".
        $req="select count(*) from brassin where dateBrass ='".$date."';";
        $nbBrassinJr=$this->laConnexion->query($req);
        $lesLignes=$nbBrassinJr->fetchAll();
        $val = $lesLignes[0];
        $val2=$val[0];
        
        $truc = explode("-",$date);
        $date= $truc[2].$truc[1].$truc[0];
        
        if($val2 < 10)
        {
            $leNb = "00".$val2;
        }
        if($val2 > 10)
        {
            $leNb = "0".$val2;
        }
        
        $IDBrass = "B".$leNb.$date;

        return $IDBrass;
    }
}
?>