<?php
session_start();
if (isset($_SESSION['access'])) {
  header ('Location: ../profile/');
  exit();
}


include("authenticate.php");

if(isset($_POST['userLogin'])){
	// run information through authenticator
	if(authenticate($_POST['userLogin'],$_POST['userPassword']))
	{
		// authentication passed
		header("Location: ../profile/");
		die();
	} else {
		// authentication failed
		header("Location: ../login/?Login failed");
		$error = 1;
	}
}
 
// output error to user
 
if(isset($error) ) echo "Login failed, or rights <br><br /-->";

// output logout success
if(isset($_GET['out'])) echo "Logout successful";
?>

<!DOCTYPE html>
<html lang="en" class="coming-soon">

<!-- Mirrored from avenxo.kaijuthemes.com/extras-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 18:21:21 GMT -->
<head>
    <meta charset="utf-8">
    <title>Connexion | ISETN</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="Ramzi BENZAID">

    <link type="text/css" href="../assets/plugins/iCheck/skins/minimal/blue.css" rel="stylesheet">
    <link type="text/css" href="../assets/fonts/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" href="../assets/fonts/themify-icons/themify-icons.css" rel="stylesheet">             
	  <!-- Themify Icons -->
    <link type="text/css" href="../assets/css/styles.css" rel="stylesheet">
      
      <link rel="icon" type="image/x-icon" href="../assets/img/favicon/fav.png" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link type="text/css" href="assets/css/ie8.css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
    

    </head>

    <body class="focused-form animated-content">
        
        
<div class="container" id="login-form">
	<a href="#" class="login-logo"><img src="../assets/img/logo-big.png"></a>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2>Connectez-vous</h2>
					</div>
					<div class="panel-body">
						
						<form action="index.php" method="post" class="form-horizontal" >
							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">							
										<span class="input-group-addon">
											<i class="ti ti-user"></i>
										</span>
										<input type="text" class="form-control" name="userLogin" required  placeholder="Adresse e-mail" >
									</div>
		                        </div>
							</div>

							<div class="form-group mb-md">
		                        <div class="col-xs-12">
		                        	<div class="input-group">
										<span class="input-group-addon">
											<i class="ti ti-key"></i>
										</span>
										<input type="password" class="form-control" name="userPassword" required placeholder="Mot de passe">
									</div>
		                        </div>
							</div>

							<div class="form-group mb-n">
								<div class="col-xs-12">
									<a href="../forgotpassword/" class="pull-left">Récupérer mot de passe?</a>
									<div class="checkbox-inline icheck pull-right p-n">
										<label for="">
											<input type="checkbox"></input>
											Rester Connecté
										</label>
									</div>
								</div>
							</div>
							
								
					
					</div>
					<div class="panel-footer">
						<div class="clearfix">
							<button class="btn btn-primary pull-right">Connexion</button>
							
						</div>
					</div>
				</div>

				</form>
			</div>
		</div>
</div>

    
    
    <!-- Load site level scripts -->

<!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

<script type="text/javascript" src="../assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
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

<!-- Mirrored from avenxo.kaijuthemes.com/extras-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 22 Apr 2017 18:21:21 GMT -->
</html>