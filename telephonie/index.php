<?php require_once('../Connections/isetn.php'); ?>
<?php
session_start();


$maxRows_row_extension = 10;
$pageNum_row_extension = 0;
if (isset($_GET['pageNum_row_extension'])) {
  $pageNum_row_extension = $_GET['pageNum_row_extension'];
}
$startRow_row_extension = $pageNum_row_extension * $maxRows_row_extension;

mysql_select_db($database_isetn, $isetn);
$query_row_extension = "SELECT * FROM demande";
$query_limit_row_extension = sprintf("%s LIMIT %d, %d", $query_row_extension, $startRow_row_extension, $maxRows_row_extension);
$row_extension = mysql_query($query_limit_row_extension, $isetn) or die(mysql_error());
$row_row_extension = mysql_fetch_assoc($row_extension);

if (isset($_GET['totalRows_row_extension'])) {
  $totalRows_row_extension = $_GET['totalRows_row_extension'];
} else {
  $all_row_extension = mysql_query($query_row_extension);
  $totalRows_row_extension = mysql_num_rows($all_row_extension);
}
$totalPages_row_extension = ceil($totalRows_row_extension/$maxRows_row_extension)-1;

$colname_row_res_demande = "-1";
if (isset($_SESSION['cn'])) {
  $colname_row_res_demande = (get_magic_quotes_gpc()) ? $_SESSION['cn'] : addslashes($_SESSION['cn']);
}
mysql_select_db($database_isetn, $isetn);
$query_row_res_demande = sprintf("SELECT * FROM resultat_demande WHERE utilisateur = '%s'", $colname_row_res_demande);
$row_res_demande = mysql_query($query_row_res_demande, $isetn) or die(mysql_error());
$row_row_res_demande = mysql_fetch_assoc($row_res_demande);
$totalRows_row_res_demande = mysql_num_rows($row_res_demande);

mysql_select_db($database_isetn, $isetn);
$query_row_count_dem = "SELECT * FROM demande WHERE id_service = 3";
$row_count_dem = mysql_query($query_row_count_dem, $isetn) or die(mysql_error());
$row_row_count_dem = mysql_fetch_assoc($row_count_dem);
$totalRows_row_count_dem = mysql_num_rows($row_count_dem);

error_reporting(0);


if(isset($_GET['out'])) {
	// destroy session
	session_unset();
	$_SESSION = array();
	unset($_SESSION['user'],$_SESSION['access']);
	session_destroy();
	header ('Location: ../dashboard/');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Centre Informatique | ISETN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="ISETN">
    <meta name="author" content="Ramzi BENZAID">


    <link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">        <!-- Font Awesome -->
    <link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">              <!-- Themify Icons -->
    <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">                                     <!-- Core CSS with all styles -->
    <link type="text/css" href="../assets/plugins/pines-notify/pnotify.css" rel="stylesheet">

    <link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
   <link rel="icon" type="image/x-icon" href="../assets/img/favicon/fav.png" />
    
    <style type="text/css">
  
.content {
    padding: 30px 0;
}

/***
Pricing table
***/
.pricing {
  position: relative;
  margin-bottom: 15px;
  border: 3px solid #eee;
}

.pricing-active {
  border: 3px solid #36d7ac;
  margin-top: -10px;
  box-shadow: 7px 7px rgba(54, 215, 172, 0.2);
}

.pricing:hover {
  border: 3px solid #36d7ac;
}

.pricing:hover h4 {
  color: #36d7ac;
}

.pricing-head {
  text-align: center;
}

.pricing-head h3,
.pricing-head h4 {
  margin: 0;
  line-height: normal;
}

.pricing-head h3 span,
.pricing-head h4 span {
  display: block;
  margin-top: 5px;
  font-size: 14px;
  font-style: italic;
}

.pricing-head h3 {
  font-weight: 300;
  color: #fafafa;
  padding: 16px 0;
  font-size: 20px;
  background: #009688;
  border-bottom: solid 1px #41b91c;
}

.pricing-head h4 {
  color: #bac39f;
  padding: 5px 0;
  font-size: 54px;
  font-weight: 300;
  background: #fbfef2;
  border-bottom: solid 1px #f5f9e7;
}

.pricing-head-active h4 {
  color: #36d7ac;
}

.pricing-head h4 i {
  top: -8px;
  font-size: 28px;
  font-style: normal;
  position: relative;
}

.pricing-head h4 span {
  top: -10px;
  font-size: 14px;
  font-style: normal;
  position: relative;
}

/*Pricing Content*/
.pricing-content li {
  color: #888;
  font-size: 12px;
  padding: 7px 15px;
  border-bottom: solid 1px #f5f9e7;
}

/*Pricing Footer*/
.pricing-footer {
  color: #777;
  font-size: 11px;
  line-height: 17px;
  text-align: center;
  padding: 0 20px 19px;
}

/*Priceing Active*/
.price-active,
.pricing:hover {
  z-index: 9;
}

.price-active h4 {
  color: #36d7ac;
}

.no-space-pricing .pricing:hover {
  transition: box-shadow 0.2s ease-in-out;
}

.no-space-pricing .price-active .pricing-head h4,
.no-space-pricing .pricing:hover .pricing-head h4 {
  color: #36d7ac;
  padding: 15px 0;
  font-size: 80px;
  transition: color 0.5s ease-in-out;
}

.yellow-crusta.btn {
  color: #FFFFFF;
  background-color: #f3c200;
      font-weight: 100;
}
.yellow-crusta.btn:hover,
.yellow-crusta.btn:focus,
.yellow-crusta.btn:active,
.yellow-crusta.btn.active {
    color: #FFFFFF;
    background-color: #cfa500;
}
    </style>
	   
	
<script>
function mynotif1() {

   new PNotify({
								title: 'Votre demande a été envoyée',
								text: 'Votre demande est en cours de traitement par l\'administrateur !',
								type: 'success',
								delay: 2e3,
								icon: 'ti ti-check',
								styling: 'fontawesome'
							});
}


function mynotif2() {
new PNotify({
								title: 'Votre demande a échoué',
								text: 'Il faut faire une autre demande.',
								delay: 2e3,
								icon: 'ti ti-info',
								styling: 'fontawesome'
							});
}

							
function mynotif3() {							
new PNotify({
								title: 'Erreur !',
								text: 'Il y\'a une erreur.',
								type: 'error',
								delay: 2e3,
								icon: 'ti ti-close',
								styling: 'fontawesome'
							});		
}
					
</script>

</head>

   
<?php if($_GET['alert']=="1" && isset($_SESSION['access'])){ ?>

    <body onLoad="mynotif1()" class="animated-content">
	
	<?php } else if($_GET['alert']=="2" && isset($_SESSION['access'])){ ?>
	
	 <body onload="mynotif2()" class="animated-content">
	 
	<?php } else if($_GET['alert']=="3" && isset($_SESSION['access'])){ ?>
	
	 <body onload="mynotif3()" class="animated-content">
	
	<?php  } else { ?>
	
	    <body class="animated-content">

	<?php } ?>
	
        
        <header id="topnav" class="navbar navbar-teal navbar-fixed-top" role="banner">

	<div class="logo-area">
		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="ti ti-menu"></i>
				</span>
			</a>
		</span>
		
		<a class="navbar-brand" href="../">isetn</a>

    
	</div><!-- logo-area -->


	<ul class="nav navbar-nav toolbar pull-right">

	<li class="toolbar-icon-bg hidden-xs">
            <a href="http://www.isetn.rnu.tn/" target="_blank"><span class="icon-bg"><i class="ti ti-world"></i></span></a>
      </li>


  <li class="toolbar-icon-bg hidden-xs">
            <a href="../dashboard/"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
      </li>

		
		 <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
        </li>


      
       
 
 
 
 
		
	
		<li class="dropdown toolbar-icon-bg">
			<?php if (!isset($_SESSION['access'])) {  ?>


			<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<img class="img-circle" src="../assets/demo/avatar/avatar_15.png" alt="" />
			</a>




			<ul class="dropdown-menu userinfo arrow">

			<li><a href="../login/"><i class="ti ti-shift-left"></i><span>Se Connecter</span></a></li>
			
				
				
				<li class="divider"></li>

				<li><a href="../reglements/"><i class="ti  ti-info-alt"></i><span>Règlements et directives</span></a></li>
			
			</ul>

<?php } else {?>


		<a href="#" class="dropdown-toggle username" data-toggle="dropdown">
				<img class="img-circle" src="../assets/demo/avatar/avatar_11.png" alt="" />
		  </a>

<ul class="dropdown-menu userinfo arrow">
				<li><a href="../profile/"><i class="ti ti-user"></i><span>Profile</span></a></li>
				<li><a href="../profilepwd/"><i class="ti ti-settings"></i><span>Changer mot de passe</span></a></li>
			
				
				<li class="divider"></li>
					<li><a href="../reglements/"><i class="ti  ti-info-alt"></i><span>Règlements et directives</span></a></li>
				<li class="divider"></li>
				<li><a href="?out"><i class="ti ti-shift-right"></i><span>Se déconnecter</span></a></li>
		  </ul>

<?php } ?>
		</li>

	</ul>

</header>

        <div id="wrapper">
            <div id="layout-static">
                <div class="static-sidebar-wrapper sidebar-default">
                    <div class="static-sidebar">
                        <div class="sidebar">
	
	
	
	<div class="widget stay-on-collapse" id="widget-sidebar">
        <nav role="navigation" class="widget-body">
	<ul class="acc-menu">
		<li class="nav-separator"></li>
		<li><a href="javascript:;"><i class="ti ti-home"></i><span>Centre Informatique</span></a>

		<ul class="acc-menu">
				<li><a href="../organisation/">Organisation</a></li>
				<li><a href="../personnelci/">Personnel du Ci</a></li>
					
			</ul>
			</li>

		
		
						<li><a href="javascript:;"><i class="ti ti-user"></i><span>Accès comptes identités</span></a>

						<ul class="acc-menu">
				<li><a href="../activation/">Création - Activation</a></li>
				<li><a href="../blocage/">Blocage - fermeture</a></li>
				<li><a href="../reglementmotdepasse/">Règles pour le mot de passe</a></li>
				<li><a href="../formulaire/">Formulaires</a></li>
				
					
			</ul>

			</li>

		<li><a href="javascript:;"><i class="ti  ti-signal"></i><span>Réseau Wi-Fi</span></a>
			<ul class="acc-menu">
				<li><a href="../wifi/">Accès au réseau sans fil</a></li>
				<li><a href="../reglementwifi/">Règles d'utilisation du wifi</a></li>

				
					
			</ul>
		</li>
				<li><a href="../impression/"><i class="ti ti-printer"></i><span>Impression</span></a>

		
			</li>

			

<li><a href="../agenda/"><i class="ti ti-email"></i><span>Mail/Agenda</span></a>				
			</li>
				<li><a href="../documentation/"><i class="ti ti-files"></i><span>Documentation</span></a>
				
			</li>
				<li><a href="javascript:;"><i class="ti ti-arrow-circle-right"></i><span>Services au personnel</span></a>

				<ul class="acc-menu">
				<li><a href="../reglements/">Règlements et directives</a></li>
				<li><a href="../mail/">E-mail</a></li>
				<li><a href="../telephonie/">Téléphonie IP</a></li>
				<li><a href="../telechargement/">Téléchargement</a></li>
				<li><a href="../bureau/">Bureau à distance</a></li>
				
					
			</ul>
			</li>

			
				<li><a href="javascript:;"><i class="ti ti-arrow-circle-right"></i><span>Services aux enseignants</span></a>
			<ul class="acc-menu">
				<li><a href="../reglements/">Règlements et directives</a></li>
				<li><a href="../elearning/">E-learning</a></li>
				<li><a href="../mail/">E-mail</a></li>
				<li><a href="../telephonie/">Téléphonie IP</a></li>
				<li><a href="../telechargement/">Téléchargement</a></li>
				<li><a href="../hebergement/">Hébergement</a></li>
				<li><a href="../vbureau/">Bureau virtuel</a></li>
				<li><a href="../cloud/">Cloud Computing</a></li>
					
			</ul>
		</li>

		<li><a href="javascript:;"><i class="ti ti-arrow-circle-right"></i><span>Services aux étudiants</span></a>
			<ul class="acc-menu">

				<li><a href="../reglements/">Règlements et directives</a></li>
				<li><a href="../elearning/">E-learning</a></li>
				<li><a href="../mail/">E-mail</a></li>
				<li><a href="../telephonie/">Téléphonie IP</a></li>
				<li><a href="../telechargement/">Téléchargement</a></li>
				<li><a href="../vbureau/">Bureau virtuel</a></li>
				<li><a href="../cloud/">Cloud Computing</a></li>
				
					
			</ul>
		</li>
      
     



		<li><a href="../help/"><i class="ti ti-help"></i><span>Help desk</span></a>
			
		</li>
	
	<br>
		

		
	</ul>
</nav>
    </div>

  
</div>
                    </div>
                </div>
                <div class="static-content-wrapper">
                    <div class="static-content">
                        <div class="page-content">
                            <ol class="breadcrumb">
                                
<li><a href="../">Home</a></li>
<li><a href="#">Téléphonie IP</a></li>


                            </ol>
                            <div class="container-fluid">
							
					
<div class="row">
		<div class="col-md-12">
		
			<div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
				<div class="panel-heading">
					<h2>Téléphonie IP</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}">
			
				
				</div>

			</div>





				<div class="panel-body" style="display: block;">
					
						<p class="m0">
						Téléohonie IP est une technique qui permet de communiquer par la voix (ou via des flux multimédia : audio ou vidéo) sur des réseaux compatibles IP, qu'il s'agisse de réseaux privés ou d'Internet, filaire (câble/ADSL/optique) ou non (satellite, Wi-Fi, GSM, UMTS ou LTE).
						</p>
						
						<p class="m0">

						Pour l'utilisation de ce service, il faut installer d'autre outils et le configurer comme:
						<ul>
							<li><a href="https://www.zoiper.com/" target="blanck"><img src="..\assets\img\zoiper-logo.png" width="72px"> </a></li>
							<li><a href="https://www.3cx.com/" target="blanck"><img src="..\assets\img\3cx.png" width="72px"></a></li>
							
						</ul>

					</p>

				</div>
			</div>
		</div>
	</div>
							
							
                                
<div class="row">

	
	
	
	
	
	<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Téléphonie IP</span> </div>

			<div><center><img src="../assets/img/voip.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary">


			<?php if (isset($_SESSION['access'])) {  ?>

			<a href="" data-toggle="modal" data-target="#tel_service" >Demander ce service</a> 

			<?php } else {?> 

<a href="../login/?redirect=telephonie">Demander ce service</a> 

				<?php } ?>

			<i class="fa fa-level-down"></i></span></div>

		</div>
	</div>

	
	

	
	<?php if (($totalRows_row_count_dem > 0) && ($row_row_count_dem['nom_complet']==$_SESSION['cn']) && ($row_row_count_dem['id_service']=="3")) { // Show if recordset not empty ?>

	    <div class="col-md-3">
	      <div class="pricing hover-effect">
	        <div class="pricing-head">
			
			<?php if($row_row_count_dem['statut']=="En attente !"){ ?>
			 <h3>Demande en attente !</h3>
			 
			 <?php } else { ?>
			 
	          <h3>Extension Téléphone IP</h3>
			  <?php } ?>
			  
			      </div>
				          
				<div class="pricing-footer">
				  <br>
				  <p>
				    Protéger Vos Coordonnées confidentielles contre l'usurpation.				    </p>
					
					<?php if($row_row_count_dem['statut']=="En attente !"){ ?>
					
			 <a href="" data-toggle="modal" data-target="#tel_demande_attente" class="btn yellow-crusta">
		                Voir plus				      </a>		
			 
			 <?php } else { ?>
			 
			            <a href="" data-toggle="modal" data-target="#tel_demande" class="btn yellow-crusta">
		                Voir plus				      </a>				  
						
						<?php } ?> 
						
				  </div>
	            </div>
	          </div>
	  
	  <?php } // Show if recordset not empty ?>
	  
	  
	  
	  
	  
	  <div class="modal fade" id="tel_service" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h2 class="modal-title">Demande du compte téléphonie IP</h2>
									</div>


  <?php if($totalRows_row_count_dem < 1){ ?>
  
									<form method="POST" action="demande.php">
									<div class="modal-body">
										<label>Nom complet</label>

										<input  type="text" value="<?php  echo $_SESSION['cn']; ?>" disabled="disabled" name="nom_complet1" class="bootbox-input bootbox-input-text form-control">
							<input  type="text" value="<?php  echo $_SESSION['cn']; ?>"  name="nom_complet" style="display:none;">
										<br>
                                        <label>Email</label>

										<input  type="text" value="<?php  echo $_SESSION['user']; ?>" disabled="disabled"  name="mail1" class="bootbox-input bootbox-input-text form-control">
										
										<input  type="text" value="<?php  echo $_SESSION['user']; ?>"   name="mail" style="display:none;">
	                                     <br>
	                                      <label>Catégorie</label>

										<input  type="text" disabled="disabled"  value="<?php echo $_SESSION['access2']; ?>" name="categorie1" class="bootbox-input bootbox-input-text form-control">
										
										<input  type="text"  value="<?php echo $_SESSION['access2']; ?>" name="categorie" style="display:none;">
	                                     <br>
										<label>Veuillez préciser votre besoin</label>

										<textarea name="besoin" required rows="3" class="bootbox-input bootbox-input-text form-control"></textarea>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										<button type="submit" class="btn btn-primary" >Démander ce service</button>
									
									</div>
									</form>
									
									 <?php } else if(($totalRows_row_count_dem >= 1)&& ($row_row_count_dem['id_service']=="3")) { ?>
					 
					 <div class="modal-body">
                        <center>
                          <img src="../assets/img/Cancel.png"><br>
                          <h3>Tu n'a pas le droit de demander un espace d'hébergement.</h3>
                        </center>
                      </div>
					 
					 <?php } ?>
					 
					 
								</div>
							</div>
			  </div>


	

				<div class="modal fade" id="tel_demande" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h2 class="modal-title">Information du compte</h2>
									</div>

									<form method="POST" action="">
									<div class="modal-body">
                                     
                                        <label>Nom complet</label>

										<input  type="text" value="<?php echo $row_row_res_demande['utilisateur']; ?>" disabled="disabled" name="nom_complet" class="bootbox-input bootbox-input-text form-control">

									     <br>
										<label>Extension</label>

										<input  type="text" value="<?php echo $row_row_res_demande['extension']; ?>" disabled="disabled" name="nom_complet1" class="bootbox-input bootbox-input-text form-control">
										<br>
                                        <label>Mot de passe</label>

										<input  type="text" value="<?php echo $row_row_res_demande['password']; ?>" disabled="disabled"  name="mail1" class="bootbox-input bootbox-input-text form-control">
										
										<br>
                                        <label>FQDN</label>

										<input  type="text" value="isetnabeul.3cx.at" disabled="disabled"  name="mail1" class="bootbox-input bootbox-input-text form-control">
										
										
									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										
									
									</div>
									</form>
								</div>
							</div>
				</div>




				<div class="modal fade" id="tel_demande_attente" >
							<div class="modal-dialog">
								<div class="modal-content">
									
									<div class="modal-body">
										<center><img src="../assets/img/loading.png"><br>
										<h3>Votre demande est en cours de traitement.</h3>
										</center>

									</div>
									
								</div>
							</div>
				</div>


	
</div>








	





                            </div> <!-- .container-fluid -->
                        </div> <!-- #page-content -->
                    </div>
                    <footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li><h6 style="margin: 0;">Made with <span class="fa fa-heart"></span> by <a href="../ci/" target="_blank">Centre Informatique</a></h6></li>
        </ul>
        <button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i class="ti ti-arrow-up"></i></button>
    </div>
</footer>


                </div>
            </div>
        </div>


  
   
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->


<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> 	

<script src="../assets/js/bs-modal-fullscreen.js"></script>
<script type="text/javascript" src="../assets/js/js.js"></script> 	


						<!-- Load jQuery -->
<script type="text/javascript" src="../assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
<script type="text/javascript" src="../assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
<script type="text/javascript" src="../assets/plugins/velocityjs/velocity.ui.min.js"></script>

<script type="text/javascript" src="../assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

<script type="text/javascript" src="../assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->
<script type="text/javascript" src="../assets/plugins/bootstrap-switch/bootstrap-switch.js"></script> 		<!-- Swith/Toggle Button -->

<script type="text/javascript" src="../assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

<script type="text/javascript" src="../assets/plugins/iCheck/icheck.min.js"></script>     					<!-- iCheck -->

<script type="text/javascript" src="../assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->
<script type="text/javascript" src="../assets/plugins/pines-notify/pnotify.min.js"></script>

<script type="text/javascript" src="../assets/js/application.js"></script>
<script type="text/javascript" src="../assets/demo/demo.js"></script>
<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    

    <!-- End loading page level scripts-->

    </body>

<!-- Mirrored from avenxo.kaijuthemes.com/ui-tiles.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 18:18:17 GMT -->
</html>
<?php
mysql_free_result($row_extension);

mysql_free_result($row_res_demande);

mysql_free_result($row_count_dem);
?>