
<?php
error_reporting(0);
// Initialize session
session_start();



 
function authenticate($user, $password) {
	if(empty($user) || empty($password)) return false;
 


	// isetn.net Active Directory server
	$ldap_host = "10.0.2.15";
 
	// Active Directory DN
	$ldap_dn = "OU=Institut Superieur des Etudes Technologiques de Nabeul,DC=isetn,DC=net";
 
	// Active Directory user group
	$ldap_user_group = "Utilisateurs";
 
	// Active Directory manager group
	$ldap_manager_group = "Administrateurs";
 
	// Domain, for purposes of constructing $user
	//$ldap_usr_dom = '@isetn.net';
 
	// connect to active directory
	$ldap = ldap_connect($ldap_host);
 
	// verify user and password
	if($bind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(userPrincipalName=".$user.")";
		$attr = array("memberof", "givenname", "sn", "cn", "whencreated", "distinguishedname", "pwdlastset");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
        
        
	


	

		ldap_unbind($ldap);
 
		// check groups
		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }       

			// is user
			if(strpos($grps, $ldap_user_group)) $access = 1;


		if(strpos($grps, "etudiant")) $access2 = "Etudiant";

			if(strpos($grps, "enseignant")) $access2 = "Enseignant";

			if(strpos($grps, "personnel")) $access2 = "Personnel";
			

		}
 
		if($access != 0) {


			$_SESSION['pass'] = $password;
			// establish session variables
			$_SESSION['user'] = $user;
			
			$_SESSION['pr'] = $entries[0]['givenname'][0];
			$_SESSION['nom'] = $entries[0]['sn'][0];
            $_SESSION['cn'] = $entries[0]['cn'][0];
			 $_SESSION['dst'] = $entries[0]['distinguishedname'][0];
            $_SESSION['datec'] = $entries[0]['whencreated'][0];

           

if($access==1){$u="Utilisateur" ;}

	if($access==2){$u="Administrateur"; }
			
			$_SESSION['access'] = $u."<br>groupe: ".$access2;
         
		$_SESSION['access2'] = $access2;


			return true;
		} else {

			// user has no rights
			echo "<br>Ce utilisateur n'est pas affecté à aucun groupe.<br>";
	
			return false;
			
		}
 
	} else {
		// invalid name or password
		return false;
	}
}
?>