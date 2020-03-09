<?php

if(isset($_POST['uid'])){
$ldaphost = "ldap://localhost";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: redireccioerror.html'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {

    
    $usuari=trim($_POST['uid']);
    $unitat=trim($_POST['ou']);
    $dn = "uid=".$usuari.",ou=".$unitat.",dc=fjeclot,dc=net" ;
     $tot = ldap_delete($ldapconn, $dn);
		if($tot) {
			
			header('Location: exitbu.html'); 
		}else{
				header('Location: errorbu.html'); 
		}		  
} else {
	header('Location: redireccionaerror.html'); 	
}

}

}
?>