<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

/*
if ($_SESSION["connect"] == "OK")
{
  echo "Bienvenue, ".$_SESSION["login"];
}
else
{
  header("Location: ./connexion.php");
  exit();
}
*/
?>
<html>
<head>
	<title>Tableau de bord</title>

	<!-- BootStrap Css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
</head>
<body style="background-color: #F6F6F6;">
	<nav class="navbar navbar-expand-lg navbar navbar-dark" style="background-color: #0764D5;">
	            <a class="navbar-brand" href="#">Menu général</a>
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
	<div class="container-xl" style="background-color: white;">
        
        <br/>
        <div class="row">
            <div class="col-4"><h1>Brasserie Clémence</h1></div>
            <div class="col-2"><p class="text-muted">Paiement des droits</p> </div>
            <div class="col-4"><h4 class="text-right">Mois de : Juin 2020 </h4></div>
            <div class="col-2"><a href="#" class="btn btn-outline-secondary" role="button" aria-disabled="true">Autre période</a></div>
        </div>
        <br />
        <div class="row">
            <div class="col-8"><h3>Liste des brassins</h3></div>
            <div class="col-4"><a href="ajout.php" class="btn btn-outline-primary" role="button" aria-pressed="true">Nouveau brassin</a></div>
        </div>
        <br/>
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
                <tr>
                <th scope="row">12345</th>
                <td>02/06/2020</td>
                <td>Redemption</td>
                <td>6.5%</td>
                <td>200</td>
                <td>nd</td>
                <td>Modifier</td>
                <td>Supprimer</td>
                </tr>
                <tr>
                <th scope="row">12378</th>
                <td>04/06/2020</td>
                <td>Douceur</td>
                <td>4.8%</td>
                <td>150</td>
                <td>nd</td>
                <td>Modifier</td>
                <td>Supprimer</td>
                </tr>
            </tbody>
        </table>
        <br />
        <div class="row">
            <div class="col-8"><h3>Liste des Mouvements</h3></div>
           <a href="#" class="btn btn-outline-primary" role="button" aria-pressed="true">Nouveau mouvement</a></div>
        <br />
  		<table class="table table-striped">
            <thead>
                <tr>
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
                <tr>
                <th scope="row">02/06/2020</th>
                <td>Redemption</td>
                <td>6.5%</td>
                <td>0,33</td>
                <td>180</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>180</td>
                <td>0</td>
                <td>0,00€</td>
                <td>Modifier</td>
                <td>Supprimer</td>
                </tr>
                
            </tbody>
        </table>
        <br/>
  	</div>
</body>
</html>