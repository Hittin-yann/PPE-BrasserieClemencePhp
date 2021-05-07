<!DOCTYPE html>
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

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

    if(isset($_GET["id"]))
    {
        $lemouv = $base->recupMouvement($_GET["id"]);
    }
    else
    {
        header("Location: ./index.php");
        exit();
    }
?>

<html>
	<head>
		<title>Modifier Mouvement</title>
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
                <div class="col align-self-start">
                    <center><h2>Modifier un mouvement</h2></center>
                    <!--Zone de modification des mouvements-->
                    <form name="nvBrassin" method="POST" action="">
                        <div class="form-group">
                            <label for="dateBrassage">Date : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateMouv" value=<?php echo "'".$lemouv->getDate()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Nombre de bouteilles : </label>
                            <input type="text" class="form-control" name="nbBout" value=<?php echo "'".$lemouv->getNbBouteilles()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Contenance : </label>
                            <input type="text" class="form-control" name="contenance" value=<?php echo "'".$lemouv->getContenance()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Stock début de mois :  </label>
                            <input type="text" class="form-control" name="stockDeb" value=<?php echo "'".$lemouv->getStockDebMois()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Stock réalisé :  </label>
                            <input type="text" class="form-control" name="stockReal" value=<?php echo "'".$lemouv->getStockRealise()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Sorties vendues :  </label>
                            <input type="text" class="form-control" name="sortiesVend" value=<?php echo "'".$lemouv->getSortiesVendues()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Sorties dégustation :  </label>
                            <input type="text" class="form-control" name="sortiesDeg" value=<?php echo "'".$lemouv->getSortiesDeg()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Stock fin de mois :  </label>
                            <input type="text" class="form-control" name="stockFin" value=<?php echo "'".$lemouv->getStockFinMois()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Volume des sorties :  </label>
                            <input type="text" class="form-control" name="volumeSorties" value=<?php echo "'".$lemouv->getVolSorties()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Coût des douanes :  </label>
                            <input type="text" class="form-control" name="coutDouanes" value=<?php echo "'".$lemouv->getCoutDouanes()."'" ?> />
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKMouv" value="Confirmer" />
                    </form>
                    <?php

                        if(isset($_POST["OKMouv"]))
                        {
                            //On modifie l'objet envoyé en mettant toutes les valeurs des inputs, modifiés ou non.
                            $lemouv->setDate($_POST["dateMouv"]);
                            $lemouv->setNbBouteilles($_POST["nbBout"]);
                            $lemouv->setContenance($_POST["contenance"]);
                            $lemouv->setStockDebMois($_POST["stockDeb"]);
                            $lemouv->setStockRealise($_POST["stockReal"]);
                            $lemouv->setSortiesVendues($_POST["sortiesVend"]);
                            $lemouv->setSortiesDeg($_POST["sortiesDeg"]);
                            $lemouv->setStockFinMois($_POST["stockFin"]);
                            $lemouv->setVolSorties($_POST["volumeSorties"]);
                            $lemouv->setCoutDouanes($_POST["coutDouanes"]);

                            $base->updateMouvement($lemouv);

                            header("Location: ./index.php");
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>