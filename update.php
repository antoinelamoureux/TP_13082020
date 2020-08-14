<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <title>Modification d'un utilisateur</title>
    <link rel="stylesheet" href=styles.css>
</head>

<body>
<h1>Modification d'un utilisateur</h1>
<br>
<?php
/* ini_set('display_errors', 1);  */
//Inclusion des paramètres de connexion
include_once("myparam.inc.php");

$idcom = new mysqli(MYHOST,MYUSER,MYPASS, 'tachete'); 

if (!$idcom) {
    echo "Connexion impossible";
    exit();
} 

if (!empty($_POST['unit_price']) && !empty($_POST['product_name'])) {
    $newprice = $_POST['unit_price'];
    $product = $idcom -> escape_string($_POST['product_name']);

    $requete = "UPDATE products SET unit_price = $newprice WHERE product_name = '$product'";

    $result = $idcom -> query($requete);
    
    if ($result) {
      echo "Les données ont bien été modifiées";
    } else {
        echo "Erreur " .$idcom->error;
    }

    //Fermer la connexion au serveur
    $idcom->close();

}
else {echo "Veuillez remplir correctement le formulaire ";}

?>
</body>
</html>