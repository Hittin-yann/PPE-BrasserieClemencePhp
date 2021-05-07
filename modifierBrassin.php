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

    if(isset($_GET["code"]))
    {
        $lebrass = $base->recupBrassin($_GET["code"]);
    }
    else
    {
        header("Location: ./index.php");
        exit();
    }
?>

<html>
	<head>
		<title>Modifier Brassin</title>
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
                    <center><h2>Modifier un brassin</h2></center>
                    <!--Zone de modification des brassins-->
                    <form name="nvBrassin" method="POST" action="">
                        <div class="form-group">
                            <label for="dateBrassage">Date de Brassage : </label>
                            <input type="date" class="form-control" min="2020-01-01" name="dateBrassage" value=<?php echo '"'.$lebrass->getDateBrass().'"' ?> />
                        </div>
                        <div class="form-group">
                            <label for="nomCommercial"> Nom commercial : </label>
                            <select name=nomCommercial class="form-control">
                                <?php
                                    $tab=$base->getBiere();

                                    //On sélectionne toutes les bières existantes et on range leur id en affichant leur nom, et on affiche celle que le brassin représente.
                                    foreach($tab as $ligne)
                                    {
                                    	$selec = "";
                                    	if($ligne->getNom() == $lebrass->getNomCom())
                                    	{
                                    		$selec = "selected=''";
                                    	}
                                        
                                        echo "<option ".$selec." value='".$ligne->getId()."'>".$ligne->getNom()."</option>";
                                    }
                                ?>
                            </select>     
                        </div>
                        <div class="form-group">
                            <label for="prcAlcool">Pourcentage d'alcool : </label>
                            <input type="text" class="form-control" name="prcAlcool" value=<?php echo "'".$lebrass->getPourAlcool()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="volumeAlcool">Volume : </label>
                            <input type="text" class="form-control" name="volumeAlcool" value=<?php echo "'".$lebrass->getVolume()."'" ?> />
                        </div>
                        <div class="form-group">
                            <label for="dateMiseBouteille">Date de mise en bouteille :  </label>
                            <input type="date" class="form-control"min="2020-01-01" name="dateMiseBouteille" value=<?php echo "'".$lebrass->getDateMiseBout()."'" ?> />
                        </div>
                        <input type="submit" class="btn btn-primary" name="OKBrass" value="Confirmer" />
                    </form>
                    <?php

                        if(isset($_POST["OKBrass"]))
                        {
                            //On modifie l'objet envoyé en mettant toutes les valeurs des inputs, modifiés ou non.
                            $lebrass->setDateBrass($_POST["dateBrassage"]);
                            $lebrass->setPourAlcool($_POST["prcAlcool"]);
                            $lebrass->setVolume($_POST["volumeAlcool"]);
                            $lebrass->setDateMiseBout($_POST["dateMiseBouteille"]);
                            $IDB = $_POST["nomCommercial"];

                            $base->updateBrassin($lebrass, $IDB);

                            header("Location: ./index.php");
                        }

                    ?>
                </div>
            </div>
        </div>
    </body>
</html>