<?php


$cnx=mysql_connect("localhost", "root", "");
$db=mysql_select_db("isetn");

  error_reporting(0);

	$cn=$_POST['nom_complet'];

    $categ = $_POST['categorie'];
	$mail = $_POST['mail'];
	$besoin=$_POST['besoin'];
	$id_service="3";
	$statut="En attente !";
	
 	


 if (!empty($cn)){

$sql="INSERT INTO demande (id_demande, nom_complet, mail, categorie, sdomaine, besoin, type_cloud, environement, statut, id_service, id_utilisateur) VALUES (NULL, '$cn', '$mail', '$categ',NULL, '$besoin', NULL, NULL, '$statut', '$id_service', NULL)";


   
    if( mysql_query($sql, $cnx) ){
	
	header('Location:../telephonie/?alert=1&votre demande envoyee!'); 
  
	  }else{
	  
	header('Location:../telephonie/?alert=2&votre demande non valide!'); 
	 
	  }}else{
	  
	  header('Location:../telephonie/?alert=3&Erreur'); 
	  }
	  
	  ?>