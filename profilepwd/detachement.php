<?php 


error_reporting(0);
session_start();

if (!isset($_SESSION['access'])) {
  header ('Location: ../dashboard/');
  exit();
}



    
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

    $attrs = array("dn", "samaccountname", "pwdlastset", "userprincipalname");
    $filter = "(userPrincipalName=".$_SESSION['user'].")";
    $sr = ldap_search($ds, $ldapBase, $filter, $attrs);
    $ent= ldap_get_entries($ds,$sr);
    $dn=$ent[0]["dn"];
    $userdata=array();


    $userdata["useraccountcontrol"][0]=66048;

    ldap_modify($ds, $dn, $userdata); 

    ldap_close($ds);



?>

<html>
<head>
    <title>Changement mot de passe</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="/favicon.ico" />
    <meta name="robots" content="noindex" />
    <style type="text/css"><!--
    body {
        color: #444444;
        background-color: #EEEEEE;
        font-family: 'Trebuchet MS', sans-serif;
        font-size: 80%;
    }
    h1 {}
    h2 { font-size: 1.2em; }
    #page{
        background-color: #FFFFFF;
        width: 60%;
        margin: 24px auto;
        padding: 12px;
    }
    #header{
        padding: 6px ;
        text-align: center;
    }
    .header{ background-color: #83A342; color: #FFFFFF; }
    #content {
        padding: 4px 0 24px 0;
    }
    #footer {
        color: #666666;
        background: #f9f9f9;
        padding: 10px 20px;
        border-top: 5px #efefef solid;
        font-size: 0.8em;
        text-align: center;
    }
    #footer a {
        color: #999999;
    }
    --></style>
</head>
<body>
    <div id="page">
        <div id="header" class="header">
            <h1>Votre mot de passe a été modifié avec succès.</h1>
        </div>
       
        <div id="footer">
           
        </div>
    </div>
</body>
</html>
