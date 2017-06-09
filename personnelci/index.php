<?php

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
    
    <style type="text/css">
    	
    	.profile-header-container{
    margin: 0 auto;
    text-align: center;
}

.profile-header-img {
    padding: 54px;
}

.profile-header-img > img.img-circle {
    width: 120px;
    height: 120px;
    border: 2px solid #51D2B7;
}

.profile-header {
    margin-top: 43px;
}

/**
 * Ranking component
 */
.rank-label-container {
    margin-top: -19px;
    /* z-index: 1000; */
    text-align: center;
}

.label.label-default.rank-label {
    background-color: rgb(81, 210, 183);
    padding: 5px 10px 5px 10px;
    border-radius: 27px;
}



.nav.nav-justified > li > a { position: relative; }
.nav.nav-justified > li > a:hover,
.nav.nav-justified > li > a:focus { background-color: transparent; }
.nav.nav-justified > li > a > .quote {
    position: absolute;
    left: 0px;
    top: 0;
    opacity: 0;
    width: 30px;
    height: 30px;
    padding: 5px;
    background-color: #13c0ba;
    border-radius: 15px;
    color: #fff;  
}
.nav.nav-justified > li.active > a > .quote { opacity: 1; }
.nav.nav-justified > li > a > img { box-shadow: 0 0 0 5px #13c0ba; }
.nav.nav-justified > li > a > img { 
    max-width: 100%; 
    opacity: .3; 
    -webkit-transform: scale(.8,.8);
            transform: scale(.8,.8);
    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.nav.nav-justified > li.active > a > img,
.nav.nav-justified > li:hover > a > img,
.nav.nav-justified > li:focus > a > img { 
    opacity: 1; 
    -webkit-transform: none;
            transform: none;
    -webkit-transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            transition: all 0.3s 0s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.tab-pane .tab-inner { padding: 30px 0 20px; }

@media (min-width: 768px) {
    .nav.nav-justified > li > a > .quote {
        left: auto;
        top: auto;
        right: 20px;
        bottom: 0px;
    }  
}




}

    </style>

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
<li><a href="#">Centre Informatique</a></li>


                            </ol>
                            <div class="container-fluid">
							
					
<div class="row">
	
<div class="[ container text-center ]">
	<div class="[ row ]">
		<div class="[ col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 ]" role="tabpanel">
            <div class="[ col-xs-4 col-sm-12 ]">
                <!-- Nav tabs -->
                <ul class="[ nav nav-justified ]" id="nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#dustin" aria-controls="dustin" style="padding: 11px 5px;"   role="tab" data-toggle="tab">
                            <img class="img-circle" src="../assets/demo/avatar/128.jpg" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#daksh" aria-controls="daksh" style="padding: 11px 5px;"  role="tab" data-toggle="tab">
                            <img class="img-circle" src="../assets/demo/avatar/128 (1).jpg" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#anna" aria-controls="anna"  style="padding: 11px 5px;" role="tab" data-toggle="tab">
                            <img class="img-circle" src="../assets/demo/avatar/128 (2).jpg" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                    <li role="presentation" class="">
                        <a href="#wafer" aria-controls="wafer" style="padding: 11px 5px;"  role="tab" data-toggle="tab">
                            <img class="img-circle" src="../assets/demo/avatar/128 (1).jpg" />
                            <span class="quote"><i class="fa fa-quote-left"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="[ col-xs-8 col-sm-12 ]">
                <!-- Tab panes -->
                <div class="tab-content" id="tabs-collapse">            
                    <div role="tabpanel" class="tab-pane fade in active" id="dustin">
                        <div class="tab-inner">                    
                            <p class="lead">Centre informatique (Ci) de l'Institut Séperieur des Etudes Technologiques de Nabeul.</p>
                            <hr>
                            <p><strong class="text-uppercase">Slah ben hmida</strong></p>
                            <p><em class="text-capitalize"> Directeur du centre informatique</em> à <a href="#">ISETN</a></p>                 
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="daksh">
                        <div class="tab-inner">
                            <p class="lead">Centre informatique (Ci) de l'Institut Séperieur des Etudes Technologiques de Nabeul.</p>
                            <hr>
                            <p><strong class="text-uppercase">Daksh Bhagya</strong></p>
                            <p><em class="text-capitalize"> Technicien Superieur en Informatique</em> à <a href="#">Département informatique</a></p>
                        </div>
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="anna">
                        <div class="tab-inner">
                            <p class="lead">Centre informatique (Ci) de l'Institut Séperieur des Etudes Technologiques de Nabeul.</p>
                            <hr>
                            <p><strong class="text-uppercase">Anna Pickard</strong></p>
                            <p><em class="text-capitalize">Technicien Superieur en Informatique</em> à <a href="#">Département genie civil</a></p>
                        </div> 
                    </div>
                    
                    <div role="tabpanel" class="tab-pane fade" id="wafer">
                        <div class="tab-inner">
                            <p class="lead">Centre informatique (Ci) de l'Institut Séperieur des Etudes Technologiques de Nabeul.</p>
                            <hr>
                            <p><strong class="text-uppercase">Wafer Baby</strong></p>
                            <p><em class="text-capitalize"> Technicien Superieur en Informatique</em> à <a href="#">Département Mécanique</a></p>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
	</div>



</div>

<br><br>
	</div>
							
							
                                
<div class="row">

	
	
	
		

<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>E-learning</span> </div>

			<div><center><img src="../assets/img/elearning.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../elearning/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>
	
	
	
		<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>E-mail</span> </div>

			<div><center><img src="../assets/img/mail.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../mail/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>
	
	
	<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Téléphonie IP</span> </div>

			<div><center><img src="../assets/img/voip.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../telephonie/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>



	



		<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Téléchargement</span> </div>

			<div><center><img src="../assets/img/telechargement.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../telechargement/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>



<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Hébergement</span> </div>

			<div><center><img src="../assets/img/hebergement.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../hebergement/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>




	<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Bureau Virtuel</span> </div>

			<div><center><img src="../assets/img/bureau.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../bureau/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>



	<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Bureau à distance</span> </div>

			<div><center><img src="../assets/img/bureaudist.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../bureau/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>



		<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Cloud Computing</span> </div>

			<div><center><img src="../assets/img/cloud.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../cloud/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

		</div>
	</div>



		<div class="col-md-3">
		<div class="info-tile tile-success" style="visibility: visible; opacity: 1; display: block; transform: translateY(0px);">
			
									 <div class="tile-heading"><span>Help desk</span> </div>

			<div><center><img src="../assets/img/help.png" width="125px"></center></div>
			<div class="tile-footer"><span class="text-primary"><a href="../help/">Plus détail</a> <i class="fa fa-level-down"></i></span></div>

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