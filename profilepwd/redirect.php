<?php 

error_reporting(0);
session_start();





function attacher($user){

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
    $filter = "(userPrincipalName=".$user.")";
    $sr = ldap_search($ds, $ldapBase, $filter, $attrs);
    $ent= ldap_get_entries($ds,$sr);
    $dn=$ent[0]["dn"];
    $userdata=array();

    $userdata["pwdlastset"][0]=0;
    $userdata["useraccountcontrol"][0]=512;


    ldap_modify($ds, $dn, $userdata); 

    ldap_close($ds);
}



function detacher($user){
    
    $ldapServer = "isetn.net";
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
    $filter = "(userPrincipalName=".$user.")";
    $sr = ldap_search($ds, $ldapBase, $filter, $attrs);
    $ent= ldap_get_entries($ds,$sr);
    $dn=$ent[0]["dn"];
    $userdata=array();


    $userdata["useraccountcontrol"][0]=66048;





    ldap_modify($ds, $dn, $userdata); 

    ldap_close($ds);
}




if ($_GET['att']==1) {
    
    attacher($_SESSION['user']);

          header ('Location: ../profilepwd/');


}

if ($_GET['att']==2) {
    
    detacher($_SESSION['user']);

          header ('Location: ../profilepwd/');
    
  
}



?>