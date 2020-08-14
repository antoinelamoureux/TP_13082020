<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Afficher les commandes par employé</title>
  </head>
  
  <body>

  <header></header>
  <h1>Ajouter un employé</h1>
    <form action="addemployee.php" method="post">
        <label>Nom:</label>
        <input type="text" name="last_name" value=""><br><br>
        <label>Prénom:</label>
        <input type="text" name="first_name" value=""><br><br>
        <label>Titre:</label>
        <input type="text" name="title"><br><br>
        <label>Titre de courtoisie:</label>
        <input type="text" name="title_courtesy"><br><br>
        <label>Date de naissance:</label>
        <input type="date" name="birthdate"><br><br>
        <label>Date d'embauche:</label>
        <input type="date" name="hiredate"><br><br>
        <label>Adrèsse:</label>
        <input type="text" name="adress" value=""><br><br>
        <label>Ville:</label>
        <input type="text" name="city" value=""><br><br>
        <label>Région:</label>
        <input type="text" name="region" value=""><br><br>
        <label>Code postal:</label>
        <input type="text" name="postal_code" value=""><br><br>
        <label>Pays:</label>
        <input type="text" name="country" value=""><br><br>
        <label>Téléphone:</label>
        <input type="text" name="home_phone" pattern="0[6-7][0-9]{8}" value=""
               placeholder="Exemple : 0602030405 sans espace ni tirets">
        <br><br>
        <label>Extension:</label>
        <input type="text" name="extension" value=""><br><br>
        <label>Notes:</label>
        <input type="text" name="notes" value=""><br><br>
        <label>Reports:</label>
        <input type="text" name="reportsto" value=""><br><br>
        <label>Photo:</label>
        <input type="text" name="photopath" value=""><br><br>
        <label>Salaire:</label>
        <input type="text" name="salary" value=""><br><br>
        <br><br>
        <input type="submit" name="valider" value="Envoyer "> &nbsp&nbsp&nbsp
        <input type="reset" value="Annuler">
    </form>
<br>
  <?php
//Inclusion des paramètres de connexion
include_once("myparam.inc.php");

$idcom = new mysqli(MYHOST,MYUSER,MYPASS, 'tachete'); 
if (!$idcom) 
{
echo "Connexion impossible à la base";
exit(); 
}
?>

<?php
   if(!empty($_POST['last_name'])) {
      $last_name = $idcom->escape_string($_POST['last_name']);
      $first_name = $idcom->escape_string($_POST['first_name']);
      $title = $idcom->escape_string($_POST['title']);
      $title_courtesy = $_POST['title_courtesy'];
      $birthdate = $_POST['birthdate'];
      $hiredate = $_POST['hiredate'];
      $adress = $idcom->escape_string($_POST['adress']);
      $city = $idcom->escape_string($_POST['city']);
      $region = $idcom->escape_string($_POST['region']);
      $postal_code = $idcom->escape_string($_POST['postal_code']);
      $country = $idcom->escape_string($_POST['country']);
      $home_phone = $idcom->escape_string($_POST['home_phone']);
      $extension = $idcom->escape_string($_POST['extension']);
      $notes = $idcom->escape_string($_POST['notes']);
      $reportsto = $idcom->escape_string($_POST['reportsto']);
      $photopath = $idcom->escape_string($_POST['photopath']);
      $salary = $_POST['salary'];

$requete = "INSERT INTO employees (last_name, first_name, title, title_courtesy, birthdate, hiredate, 
adress, city, region, postal_code, country, home_phone, extension, notes, reportsto, photopath, salary)
VALUES
('$last_name', '$first_name', '$title', '$title_courtesy', '$birthdate', '$hiredate', '$adress', '$city', 
'$region', '$postal_code', '$country', '$home_phone', '$extension', '$notes', '$reportsto', '$photopath', '$salary')";

//Envoyer la requete
$result = $idcom->query($requete);

//Vérifier que la requete est bien éxécutée
if ($result) {
    //echo "Vous avez bien été enregistré au numéro :" . $idcom->insert_id;
    echo "<script language=\"javascript\">";
    echo "alert('Vous avez bien été enregistré au numéro :.$idcom->insert_id' )";
    echo"</script>";
} else {
    echo "Erreur " . $idcom->error;
}

//Fermer la connexion au serveur
$idcom->close();
}
?>
  </body>
</html>