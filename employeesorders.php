<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Afficher les commandes par employé</title>
  </head>
  
  <body>

  <header></header>
  <h1>Afficher les commandes par employé</h1>
  <hr>
  <form method = "post" action="employeesorders.php">
       <label>Saisissez le nom de l'employé</label>
       <input type="text" name="last_name">
       <input type="submit" value="Rechercher">
</form>
<br><br>

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
   
      $nom = $idcom->escape_string($_POST['last_name']);

$requete = "SELECT * FROM orders INNER JOIN employees ON orders.employee_id = employees.employee_id WHERE employees.last_name = '$nom'";

$result = $idcom->query($requete);

if ($result->num_rows > 0) {

   echo('<table border="1">
    <colgroup width =150 span=12></colgroup
   <tr>
       <td>order_id</td>
       <td>compagny_id</td>
       <td>employee_id</td>
       <td>order_date</td>
	   <td>required_date</td>
	   <td>shipped_date</td>
	   <td>shipvia</td>
       <td>freight</td>
       <td>ship_name</td>
       <td>ship_address</td>
       <td>ship_city</td>
       <td>ship_region</td>
       <td>ship_postal_code</td>
       <td>ship_country</td>
       </tr>');

    while($donnees = $result->fetch_assoc()) {
       echo ('<tr>');
       echo ('<td>'.$donnees['order_id'].'</td>');
       echo ('<td>'.$donnees['compagny_id'].'</td>');
       echo ('<td>'.$donnees['employee_id'].'</td>');
       echo ('<td>'.$donnees['order_date'].'</td>');
       echo ('<td>'.$donnees['required_date'].'</td>');
       echo ('<td>'.$donnees['shipped_date'].'</td>');
       echo ('<td>'.$donnees['shipvia'].'</td>');
       echo ('<td>'.$donnees['freight'].'</td>');
       echo ('<td>'.$donnees['ship_name'].'</td>');
       echo ('<td>'.$donnees['ship_address'].'</td>');
       echo ('<td>'.$donnees['ship_city'].'</td>');
       echo ('<td>'.$donnees['ship_region'].'</td>');
       echo ('<td>'.$donnees['ship_postal_code'].'</td>');
       echo ('<td>'.$donnees['ship_country'].'</td>');
       echo('</tr>');
   }
       echo('</table>');
      } else {
        echo "0 results";
    }
$idcom->close(); 
}
  ?>
  
  </body>
</html>