<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Modifier le prix d'un produit</title>
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
  <header></header>
  <h1>Modifier le prix d'un produit</h1>
  <hr>
  <form method = "post" action="modifyprice.php">
       <label>Saississez le nom du produit :</label>
       <input type="text" name="product_name">
       <input type="submit" value="Rechercher et modifier">
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

if(!empty($_POST['product_name'])) {
    $product = $idcom -> escape_string($_POST['product_name']);

    $requete = "SELECT * FROM products WHERE product_name = '$product'";

    $result = $idcom -> query($requete);

if ($result) {
    echo('<table border="1">
    <colgroup width =150 span=12></colgroup
   <tr>
       <td>product_id</td>
       <td>product_name</td>
       <td>supplier_id</td>
       <td>category_id</td>
	   <td>quantity_per_unit</td>
	   <td>unit_price</td>
	   <td>units_in_stock</td>
       <td>units_on_order</td>
       <td>reorder_level</td>
       <td>discontinued</td>
       </tr>');

    while($donnees = $result->fetch_assoc()) {

       echo ('<tr>');
       echo ('<td>'.$donnees['product_id'].'</td>');
       echo ('<td>'.$donnees['product_name'].'</td>');
       echo ('<td>'.$donnees['supplier_id'].'</td>');
       echo ('<td>'.$donnees['category_id'].'</td>');
       echo ('<td>'.$donnees['quantity_per_unit'].'</td>');
       echo ('<td>'.$donnees['unit_price'].'</td>');
       echo ('<td>'.$donnees['units_in_stock'].'</td>');
       echo ('<td>'.$donnees['units_on_order'].'</td>');
       echo ('<td>'.$donnees['reorder_level'].'</td>');
       echo ('<td>'.$donnees['discontinued'].'</td>');
       echo('</tr>');
   }
       echo('</table>');
    echo "<h1>Modification du prix</h1>";
    echo "<form action=\"update.php\" method=\"post\">";
    ?>
    <label>Nom du produit: </label>&nbsp&nbsp
<?php
echo "<input type=\"text\" name=\"product_name\">";
?>
<br><br>
        <label>Nouveau prix: </label>&nbsp&nbsp
<?php
echo "<input type=\"numeric\" name=\"unit_price\">";
?>
<br><br>
    <input type="submit" name="valider" value="Modifier"> &nbsp&nbsp&nbsp
    <input type="reset" value="Annuler">
    </fieldset>
</form>
<br>
<?php
}
} else {
    echo "Veuillez saisir le nom du produit";
}
?>
  </body>
</html>