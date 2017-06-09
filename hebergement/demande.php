<?php

$cnx=mysql_connect("localhost", "root", "");
$db=mysql_select_db("isetn");


  error_reporting(0);

	
	$cn=$_POST['nom_complet'];

    $categ = $_POST['categorie'];
	$mail = $_POST['mail'];
	$besoin=$_POST['besoin'];
	$id_service="1";
	$statut="En attente !";
	
		$sdomaine=$_POST['sdomaine'];
	
 	


 if (!empty($cn)){



$sql="INSERT INTO demande (id_demande, nom_complet, mail, categorie, sdomaine, besoin, type_cloud, environement, statut, id_service, id_utilisateur) VALUES (NULL, '$cn', '$mail', '$categ','$sdomaine', '$besoin', NULL, NULL, '$statut', '$id_service', NULL)";


   
    if( mysql_query($sql, $cnx)){
	
	header('Location:../hebergement/?alert=1&votre demande envoyee!'); 
  
	  }else{
	  
	header('Location:../hebergement/?alert=2&votre demande non valide!'); 
	 
	  }}else{
	  
	  header('Location:../hebergement/?alert=3&Erreur'); 
	  }
	  
	  ?>