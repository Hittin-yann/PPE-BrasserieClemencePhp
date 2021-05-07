<!DOCTYPE html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('./classes/BDD.php');

$base = new BDD();

session_start()
?>
<html>
<head>
	<title>Connexion</title>

	<!-- BootStrap Css -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	
</head>
<body>
	<div class="container">
  		<div class="row">
  			<div class="col align-self-center">

  				<!-- Entete Connexion -->
  				<center>
	  				<br/><h2> Connexion : </h2><br/>
	  				<form name="form1" action="" method="POST">
		      			<div class="input-group mb-3">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text" id="inputGroup-sizing-default">Identifiant</span>
						  	</div>
						  	<input type="text" name="id" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
						</div>
						<div class="input-group mb-3">
						  	<div class="input-group-prepend">
						    	<span class="input-group-text" id="inputGroup-sizing-default">Mot de passe</span>
						  	</div>
						  	<input type="password" name="mdp" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
						</div>
						<input type="submit" name="ok" class="btn btn-primary"/>
					</form>
				</center>

	   		</div>
		</div>
  	</div>
  	<?php
  		if(isset($_POST['ok']))
  		{
  			$res = $base->connexion($_POST['id'], $_POST['mdp']);
  			if($res >= 1)
  			{
  				$_SESSION["connect"] = "OK";
  				$_SESSION["login"] = $_POST["id"];
  				header('Location: ./index.php');
  			}
  			else
  			{
  				echo "Login ou mot de passe incorrect";
  			}
  		}
  	?>
</body>
</html>