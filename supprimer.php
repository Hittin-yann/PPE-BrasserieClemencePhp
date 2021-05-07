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
?>
<html>
<head>
	<title>Supprimer</title>
	<meta charset="utf-8" />
</head>
<body>

<?php
	if(isset($_GET["code"]))
	{
		$base->deleteBrassin($_GET["code"]);
	}
	else
	{
		if(isset($_GET["id"]))
		{
			$base->deleteMouvement($_GET["id"]);
		}
	}
	header("Location: ./index.php");
?>

</body>
</html>