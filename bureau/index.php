<?php
error_reporting(0);

session_start();

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
<li><a href="#">Bureau à distance</a></li>


                            </ol>
                            <div class="container-fluid">
							
					
<div class="row">
		<div class="col-md-12">
		
			<div class="panel panel-default" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
				<div class="panel-heading">
					<h2>Bureau à distance</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}">
			
				
				</div>

			</div>





				<div class="panel-body" style="display: block;">
					<p class="m0">
						Avec la fonctionnalité Connexion Bureau à distance, vous pouvez vous connecter à un ordinateur exécutant Windows depuis un autre ordinateur exécutant Windows qui est connecté au même réseau ou à Internet. Par exemple, vous pouvez utiliser tous les programmes, les fichiers et les ressources réseau de votre ordinateur professionnel depuis votre ordinateur personnel, comme si vous vous trouviez au bureau.
					</p>
                    <p class="m0">
                        Pour que vous puissiez vous connecter à un ordinateur distant, celui-ci doit être allumé, disposer d’une connexion réseau et le Bureau à distance doit être activé dessus. Vous devez par ailleurs disposer d’un accès réseau à l’ordinateur distant, ainsi que des autorisations nécessaires pour vous connecter.
                        
                    </p>

				</div>
			</div>
		</div>
	</div>
							
							
                                
<div class="row">

	
	
	
		<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Bureau à distance</span> </div>

			<div><center><img src="../assets/img/bureaudist.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary">

			
          
           <?php 
           if (isset($_SESSION['access'])) { 
           	if ($_SESSION['access2']!="Personnel") {  ?>

			<a href="" data-toggle="modal" data-target="#interdit">Manuelle d'utilisation</a>

            <?php } else {?> 

			<a href="../bureau/">Manuelle d'utilisation</a> 

			<?php } }else
			{
?>
<a href="../login/?redirect=bureau">Démander ce service</a> 
<?php
				}?>

			<i class="fa fa-level-down"></i></span></div>

		</div>
	</div>
	
	
	


	


				<div class="modal fade" id="interdit" >
							<div class="modal-dialog">
								<div class="modal-content">
									
									<div class="modal-body">
										<center><img src="../assets/img/Cancel.png"><br>
										<h3>Vous n'êtes pas autorisé de consulter ce manuelle.</h3>
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

<script type="text/javascript" src="../assets/js/application.js"></script>
<script type="text/javascript" src="../assets/demo/demo.js"></script>
<script type="text/javascript" src="../assets/demo/demo-switcher.js"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    

    <!-- End loading page level scripts-->

    </body>

<!-- Mirrored from avenxo.kaijuthemes.com/ui-tiles.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 18:18:17 GMT -->
</html>