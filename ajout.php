<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Redirection en cas de non connexion.
session_start();
if ($_SESSION["connect"] != "OK")
{
    header("Location: ./connexion.php");
    exit();
}

require_once('./classes/Mouvement.php');
require_once('./classes/Brassin.php');
require_once('./classes/Biere.php');
require_once('./classes/BDD.php');

$base = new BDD();
?>
<html>
    <head>
    	<title>Ajout</title>
        <meta charset="utf-8" />

    	<!-- BootStrap Css -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    </head>

    <body style="background-color: #F6F6F6;">

    	
        <nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color: #0764D5;">
            <a class="navbar-brand" href="index.php"><img src="./logo.png" href="index.php" height="50px" width="50px" />Menu général</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        

        <div class="container col-12">    
            <div class="d-flex justify-content-between">
                <div class="col-4">
                    <h2> Nouveau type de bière </h2>
                    <!--Zone d'ajout pour les bières-->
                    <form method='POST' action='' name='nvNom'>
                    <div class="form-group">
                        <label for="nomB"> Nom : </label>
                        <input type='text' name='nomB' />
                    </div>
                    <input type='submit' class="btn btn-primary" name='OKNom' value='Confirmer' />
                    </form>
                    <?php
                        if(isset($_POST["OKNom"]))
                        {
                            $b = new Biere();
                            $b->setNom($_POST["nomB"]);

                            $base->insertBiere($b);
                        }
                    ?>
                </div>
            
            
            
                
                <div class="col-4">
                    <h2> Nouveau brassin  </h2>
                    <!--Zone d'ajout pour les brassins-->
                    <form name="nvBrassin" method="POST" action="">
                        <div class="form-group">
                            <label for="dateBrassage">Date de Brassage : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateBrassage" />
                        </div>
                        <div class="form-group">
                            <label for="nomCommercial"> Nom commercial : </label>
                            <select name=nomCommercial class="form-control">
                                <?php
                                    $tab=$base->getBiere();

                                    //On sélectionne toutes les bières existantes et on range leur id en affichant leur nom.
                                    foreach($tab as $ligne)
                                    {
                                        echo "<option value='".$ligne->getId()."'>".$ligne->getNom()."</option>";
                                    }
                                ?>
                            </select>     
                        </div>
                        <div class="form-group">
                            <label for="prcAlcool">Pourcentage d'alcool : </label>
                            <input type="text" class="form-control" name="prcAlcool" />
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Volume : </label>
                            <input type="text" class="form-control" name="volumeAlcool" />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Date de mise en bouteille :  </label>
                            <input type="date" class="form-control"min="2020-01-01" name="dateMiseBouteille" />
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKBrass" value="Confirmer"/>
                    </form>
                </div>

                <?php
                    if(isset($_POST["OKBrass"]))
                    {
                        $br = new Brassin();
                        $ID = $base->creaIDBrassin($_POST["dateBrassage"]);
                        $br->setCode($ID);
                        $br->setDateBrass($_POST["dateBrassage"]);
                        $br->setDateMiseBout($_POST["dateMiseBouteille"]);
                        $br->setVolume($_POST["volumeAlcool"]);
                        $br->setPourAlcool($_POST["prcAlcool"]);
                        //On récupère le nouvel objet brassin + l'ID de la bière qui lui correspond via le select.
                        $base->insertBrassin($br,$_POST["nomCommercial"]);
                    }
                ?>
                
                <div class="col-4">
                    <h2> Nouveau mouvement </h2>
                    <!--Zone d'ajout pour les mouvements-->
                    <form method='POST' action='' name='nvNom'>
                        Nom :<input type='text' name='nomB' />
                        <input type='submit' class="btn btn-primary" name='OKNom' value='Confirmer' />
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>