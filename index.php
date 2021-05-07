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

    /* PARTIE SPREADSHEET */

    require('/root/vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Csv;

?>
<html>
    <head>
    	<title>Tableau de bord</title>
        <meta charset="utf-8" />

    	<!-- BootStrap Css -->
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    	
    </head>
    <body style="background-color: #F6F6F6;">
        <nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color: #0764D5;">
            <a class="navbar-brand" href="#"><img src="./logo.png" href="#" height="50px" width="50px" />Menu général</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Gestion brassins/mouvements <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ventes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Livraisons</a>
                    </li>
                </ul>
            </div>
        </nav>
    	
        <div class="container" style="background-color: white;">
            <br/>
            <div class="row">
                <div class="col-4"><h1>Brasserie Clémence</h1></div>
                <div class="col-4">
                    <form action='' method='POST' name=intervalle>
                        <input type='date' name='date1' />
                        <input type='date' name='date2' />
                        <center><input type='submit' name='KK' value='Rechercher' /></center>
                    </form>
                </div>
            </div>
            <br />
            <div class="row">
                <div class="col-8"><h3>Liste des brassins</h3></div>
                <div class="col-4"><a href="./ajout.php" class="btn btn-outline-primary" role="button" aria-pressed="true">Nouveau brassin</a></div>
            </div>
            
      		<table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Brassin</th>
                    <th scope="col">Date brassage</th>
                    <th scope="col">Nom commercial</th>
                    <th scope="col">% alcool</th>
                    <th scope="col">Volume</th>
                    <th scope="col">Date de mise en bouteille</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        //Si on recherche les brassins entre 2 dates choisies, on affiche ceux disponibles.
                        if(isset($_POST['KK']))
                        {
                            if(isset($_POST['date1']) && isset($_POST['date2']))
                            {
                                $tabbrassmois = $base->getBrassinMois($_POST['date1'], $_POST['date2']);
                                $mouvementbrass = array();

                                foreach($tabbrassmois as $row)
                                {
                                    echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDateBrass()."</td><td scope='col'>".$row->getNomCom()."</td><td scope='col'>".$row->getPourAlcool()."</td><td scope='col'>".$row->getVolume()."</td><td scope='col'>".$row->getDateMiseBout()."</td><td scope='col'><a href='modifierBrassin.php?code=".$row->getCode()."'><button>Modifier</button></a></td><td scope='col'><a href='supprimer.php?code=".$row->getCode()."'><button>Supprimer</button></a></td></tr>";

                                    //On cherche tout les brassins disponibles par le biais du code du brassin de la ligne actuelle, et on le range dans un tableau.
                                    $mouvementbrass[] = $base->getMouvementBrassin($row->getCode());
                                }
                            }
                            else
                            {
                                echo "Veuillez indiquer 2 dates valides";
                            }
                        }
                        //Sinon, on les affiche tous.
                        else
                        {
                            $tabbrass = $base->getBrassin();
                            foreach($tabbrass as $ligne)
                            {
                                echo "<tr><th scope='col'>".$ligne->getCode()."</th><td scope='col'>".$ligne->getDateBrass()."</td><td scope='col'>".$ligne->getNomCom()."</td><td scope='col'>".$ligne->getPourAlcool()."</td><td scope='col'>".$ligne->getVolume()."</td><td scope='col'>".$ligne->getDateMiseBout()."</td><td scope='col'><a href='modifierBrassin.php?code=".$ligne->getCode()."'><button>Modifier</button></a></td><td scope='col'><a href='supprimer.php?code=".$ligne->getCode()."'><button>Supprimer</button></a></td></tr>";
                            }
                        }
                    ?>
                </tbody>
            </table>
            <br/>
            <div class="row">
                <div class="col-8"><h3>Liste des Mouvements</h3></div>
                <div class="col-4"><a href="#" class="btn btn-outline-primary" role="button" aria-pressed="true">Nouveau mouvement</a></div>
            </div>
            
      		<table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Date</th>
                    <th scope="col">Nom</th>
                    <th scope="col">% Alcool</th>
                    <th scope="col">Contenance</th>
                    <th scope="col">Stock début mois</th>
                    <th scope="col">Stock réalisé</th>
                    <th scope="col">Sorties vendues</th>
                    <th scope="col">Sorties dégustations</th>
                    <th scope="col">Stock fin de mois</th>
                    <th scope="col">Volume des sorties</th>
                    <th scope="col">Coût douanes</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Si on recherche les mouvements entre 2 dates choisies, on affiche ceux disponibles.
                    if(isset($_POST['KK']))
                    {
                      if(isset($_POST['date1']) && isset($_POST['date2']))
                      {
                        foreach($mouvementbrass as $case)
                        {
                          foreach($case as $row)
                          {
                           echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDate()."</td><td scope='col'>A COMPLETER</td><td scope='col'>A COMPLETER</td><td scope='col'>".$row->getContenance()."</td><td scope='col'>".$row->getStockDebMois()."</td><td scope='col'>".$row->getStockRealise()."</td><td scope='col'>".$row->getSortiesVendues()."</td><td scope='col'>".$row->getSortiesDeg()."</td><td scope='col'>".$row->getStockFinMois()."</td><td scope='col'>".$row->getVolSorties()."</td><td scope='col'>".$row->getCoutDouanes()."</td><td scope='col'><a href='modifierMouvement.php?id=".$row->getId()."'><button>Modifier</button></a></td><td scope='col'><a href='supprimer.php?id=".$row->getId()."'><button>Supprimer</button></a></td></tr>";
                          }
                        }
                      }
                    }
                    //Sinon, on les affiche tous.
                    else
                    {
    					
                      $tabmouv = $base->getMouvement();
                      foreach($tabmouv as $row)
                      {
                        echo "<tr><th scope='col'>".$row->getCode()."</th><td scope='col'>".$row->getDate()."</td><td scope='col'>".$row->getNomCommercial()."</td><td scope='col'>".$row->getPourcentageAlcool()."</td><td scope='col'>".$row->getContenance()."</td><td scope='col'>".$row->getStockDebMois()."</td><td scope='col'>".$row->getStockRealise()."</td><td scope='col'>".$row->getSortiesVendues()."</td><td scope='col'>".$row->getSortiesDeg()."</td><td scope='col'>".$row->getStockFinMois()."</td><td scope='col'>".$row->getVolSorties()."</td><td scope='col'>".$row->getCoutDouanes()."</td><td scope='col'><a href='modifierMouvement.php?id=".$row->getId()."'><button>Modifier</button></a></td><td scope='col'><a href='supprimer.php?id=".$row->getId()."'><button>Supprimer</button></a></td></tr>";
                      }
                    }
                    ?>
                </tbody>
            </table>
            <br/>
      	</div>
        <center>
            <form action='' method='POST' name='faireCSV'>
                <input class="btn btn-outline-primary" type='submit' name='OKCSV' value='Extraire fichier Excel' />
            </form>
        </center>
        <?php

            if(isset($_POST['OKCSV']))
            {
                $unfich = new Spreadsheet();
                $lefich = $unfich->getActiveSheet();

                $lefich->setCellValue('A1', 'Brassin'); $lefich->setCellValue('B1', 'Date de Brassage'); $lefich->setCellValue('C1', 'Nom Commercial'); $lefich->setCellValue('D1', '%alc'); $lefich->setCellValue('E1', 'Vol. est. (hectolitres)'); $lefich->setCellValue('F1', 'Date de mise en bouteille'); $lefich->setCellValue('G1', 'entrées'); $lefich->setCellValue('H1', 'Volume effectif des entrées');

                $letab = $base->getMouvementBrassin();

                $sauvegarde = new Csv($unfich);
                $sauvegarde->save('/var/www/html/depotcsvclemence/salut.csv');
            }
        ?>
    </body>
</html>