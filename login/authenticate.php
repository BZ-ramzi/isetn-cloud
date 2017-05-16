
<?php
error_reporting(0);
// Initialize session
session_start();
 
function authenticate($user, $password) {
	if(empty($user) || empty($password)) return false;
 


	// Active Directory server
	$ldap_host = "isetn.net";
 

	// Active Directory DN
	$ldap_dn = "OU=departement,DC=isetn,DC=net";
 
	// Active Directory user group
	$ldap_user_group = "departement";
 
	// Active Directory manager group
	$ldap_manager_group = "Administrateurs";
 
	// Domain, for purposes of constructing $user
	$ldap_usr_dom = '@isetn.net';
 
	// connect to active directory
	$ldap = ldap_connect($ldap_host);
 
	// verify user and password
	if($bind = @ldap_bind($ldap, $user.$ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(sAMAccountName=".$user.")";
		$attr = array("memberof");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);
 
		// check groups
		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if(strpos($grps, $ldap_manager_group)) { $access = 2; break; }       

			// is user
			if(strpos($grps, $ldap_user_group)) $access = 1;


			if(strpos($grps, "rsi")) $access2 = "RSI";

			if(strpos($grps, "dsi")) $access2 = "DSI";

			if(strpos($grps, "sem")) $access2 = "SEM";
			

		}
 
		if($access != 0) {
			// establish session variables
			$_SESSION['user'] = $user;
			
			
if($access==1){$u="Utilisateur" ;}
	if($access==2){$u="Administrateur"; }
			
			$_SESSION['access'] = $u."<br>groupe: ".$access2;
         
		


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