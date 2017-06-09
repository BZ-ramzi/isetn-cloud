<?php
error_reporting(0);
session_start();

if (!isset($_SESSION['access'])) {
  header ('Location: ../dashboard/');
  exit();
}



if(isset($_GET['out'])) {
	// destroy session
	session_unset();
	$_SESSION = array();
	unset($_SESSION['user'],$_SESSION['access']);
	session_destroy();
	header ('Location: ../dashboard/');
}



/************************/

  $ldapServer = "10.0.2.15";
    $ldapBase = "OU=Institut Superieur des Etudes Technologiques de Nabeul,DC=isetn,DC=net";
    $ds = ldap_connect($ldapServer);

    if (!$ds){
       die('Cannot Connect to LDAP server');
    }

    $ldapBind = ldap_bind($ds,"Administrateur@isetn.net","Admin@ci2017");

    if (!$ldapBind){
       die('Cannot Bind to LDAP server');
    }

    ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3) or die("Error setting LDAP version");

    ldap_set_option($ds, LDAP_OPT_REFERRALS, 0) or die("Error setting referrals option");

    $attrs = array("dn", "samaccountname", "pwdlastset", "userprincipalname", "useraccountcontrol");
    $filter = "(userPrincipalName=".$_SESSION['user'].")";
    $sr = ldap_search($ds, $ldapBase, $filter, $attrs);
    $ent= ldap_get_entries($ds,$sr);
  


    $bb= $ent[0]["useraccountcontrol"][0];

 
  

    ldap_close($ds);


/************************/




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

    <link type="text/css" href="../assets/plugins/codeprettifier/prettify.css" rel="stylesheet">                <!-- Code Prettifier -->
    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">              <!-- iCheck -->
   <link rel="icon" type="image/x-icon" href="../assets/img/favicon/fav.png" />
    

    </head>

    <body class="animated-content">
        
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

			

				<li><a href="../mail/"><i class="ti ti-email"></i><span>Mail/Agenda</span></a>
				
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
<li><a href="#">Profile</a></li>


                            </ol>
                                                   <div class="container-fluid">
                                 
<div data-widget-group="group1">
	<div class="row">
		<div class="col-sm-3">
			<div class="panel panel-profile">
			  <div class="panel-body">
			    <img src="../assets/demo/avatar/avatar_11.png" class="img-circle">
			    <div class="name"><?php echo $_SESSION['cn']; ?></div>
			    <div class="info"><?php echo $_SESSION['access2']?></div>
			
			  </div>
			</div><!-- panel -->
			<div class="list-group list-group-alternate mb-n nav nav-tabs">
				<a href="#tab-about" 	role="tab" data-toggle="tab" class="list-group-item active"><i class="ti ti-user"></i> A propos <span class="badge badge-primary">80%</span></a>
								

				<a href="#tab-password" role="tab" data-toggle="tab"  class="list-group-item"><i class="ti ti-pencil"></i> Changer le mot de passe</a>
			</div>
		</div><!-- col-sm-3 -->
		<div class="col-sm-9">
			<div class="tab-content">
			

				<div class="tab-pane " id="tab-about">
					<div class="panel panel-default">
					    <div class="panel-heading">
					    	<h2>A propos</h2>
					    </div>
						<div class="panel-body">
					      
							<div class="about-area">
						      	<h4>Informations de base</h4>
								    <div class="table-responsive">
								      <table class="table">
								        <tbody>
										 
										 

								          <tr>
								            <th>Rôle</th>
								            <td><?php echo $_SESSION['access2']; ?></td>
								          </tr>
								     
								          <tr>
								            <th>Prénom</th>
								            <td><?php echo $_SESSION['pr']; ?></td>
								          </tr>


										  <tr>
								            <th>Nom</th>
								            <td><?php echo $_SESSION['nom']; ?></td>
								          </tr>
								          
								          
										   <tr>
								            <th>E-mail</th>
								            <td><?php echo $_SESSION['user']; ?></td>
								          </tr>
								         
								         
								         
								        </tbody>
								      </table>
								    </div>
							</div>
							
							
							<div class="about-area">
						      	<h4>Informations de compte </h4>
								    <div class="table-responsive">
								      <table class="table">
								        <tbody>
								          <tr>
								            <th >Date de création</th>
								            <td>
<?php 
$d=$_SESSION['datec'];					
echo substr($d, 6,2)."/".substr($d, 4,2)."/".substr($d, 0,4)." ".substr($d, 8,2).":".substr($d, 10,2).":".substr($d, 12,2);
 ?>
							</td>
								          </tr>
								        
								       
								          
								        </tbody>
								      </table>
								    </div>
							</div>
							
							
						</div>
					</div>
				</div>

			

			<div class="tab-pane active" id="tab-password">
					<div class="panel panel-default">
					    <div class="panel-heading">
					    	<h2>Changement de mot de passe</h2>
					    </div>
						<div class="panel-body">
					     

					       

					     
							<div class="about-area">
						      	
								      <span class="label label-teal">Attacher</span> Appuyer sur le bouton Attacher votre compte pour activer le modification de mot de passe.
								      <br> <br>
                          <span class="label label-danger">Détacher</span> Aprés le modification de mot de passe,<font color="red"> il faut  appuyer sur le bouton Détacher pour rendre votre compte déverrouiller</font>.
 

							</div>
							
							  <div class="col-sm-8 col-sm-offset-2">


			
                  <?php  if ($bb ==512 ) { ?>
													
                        <a href="" data-toggle="modal" data-target="#detach_modal" class="btn-danger btn" >Détacher votre compte</a>
                        <a href="" data-toggle="modal" data-target="#myModal" class="btn-default btn">Changer Mot de passe</a>

                     <?php  }else?>

                       <?php if ($bb ==66048 ) { 	?>

                       	 <a href="" data-toggle="modal" data-target="#attach_modal" class="btn-primary btn">Attacher votre compte</a>
					
						
						<?php }?>
	              
									
						 
								</div>

							
							
						</div>
					</div>
				</div>
				

				<div class="modal fade" id="attach_modal" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h2 class="modal-title">Changement du mot de passe</h2>
									</div>
									<div class="modal-body">
										<p>Appuyer sur le bouton Attacher votre compte pour activer le modification de mot de passe.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										<a href="redirect.php?att=1" class="btn btn-primary">Attacher votre compte</a>
									</div>
								</div>
							</div>
						</div>


						<div class="modal fade" id="detach_modal" >
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<h2 class="modal-title">Changement du mot de passe</h2>
									</div>
									<div class="modal-body">
										<p>Aprés le modification de mot de passe,<font color="red"> il faut  appuyer sur le bouton Détacher pour rendre votre compte déverrouiller.</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
										<a href="redirect.php?att=2" class="btn btn-danger">Détacher votre compte</a>
									</div>
								</div>
							</div>
						</div>



				


<div class="modal fade modal-fullscreen" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
        </div>
        <div class="modal-body">
         <iframe width="100%" height="100%" src="https://10.0.2.15/RDWeb/Pages/fr-FR/password.aspx">
          <p>Your browser does not support iframes.</p>
        </iframe>


        </div>
        <div class="modal-footer">
        
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

<script type="text/javascript" src="../assets/js/application.js"></script>
<script type="text/javascript" src="../assets/demo/demo.js"></script>
<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    

    <!-- End loading page level scripts-->

    </body>

<!-- Mirrored from avenxo.kaijuthemes.com/ui-tiles.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 18:18:17 GMT -->
</html>