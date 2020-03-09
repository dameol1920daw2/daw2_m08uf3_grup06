<?php

if(isset($_POST['uid']) && ($_POST['nom']) && ($_POST['cognom']) && ($_POST['titol']) && ($_POST['numeroTel']) && ($_POST['movil']) && ($_POST['adressaPostal']) && ($_POST['numeroG']) && ($_POST['numeroUid']) && ($_POST['description']) && ($_POST['ou']) && ($_POST['directoriUsuari']) && ($_POST['shellUsuari']) && ($_POST['passwordU'])){
$ldaphost = "ldap://localhost";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 

$ldapconn = ldap_connect($ldaphost) or die(header('Location: redireccioerror.html'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {

$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

if($ldapbind) {    
    $info["objectclass"][0] = 'top';
    $info["objectclass"][1] = 'person';
    $info["objectclass"][2] = 'organizationalPerson';
    $info["objectclass"][3] = 'inetOrgPerson';
    $info["objectclass"][4] = 'posixAccount';
    $info["objectclass"][5] = 'shadowAccount';
    $info["cn"] = $_POST['nom'];
    $info["sn"] = trim($_POST['cognom']);
    $info["title"] = trim($_POST['titol']);
    $info["telephonenumber"] = trim($_POST['numeroTel']);
	$info["mobile"] = trim($_POST['movil']);
	$info["postaladdress"] = trim($_POST['adressaPostal']);
	$info["description"] = trim($_POST['description']);
    $info["uid"] = trim($_POST['uid']);
	$info["uidnumber"] = trim($_POST['numeroUid']);
	$info["gidnumber"] = trim($_POST['numeroG']);
	$info["loginshell"] = trim($_POST['shellUsuari']);
	$info["homedirectory"] = trim($_POST['directoriUsuari']);
	$info["userPassword"] = trim($_POST['passwordU']);
	$info["givenname"] = trim($_POST['nom'])." ".trim($_POST['cognom']);


	$dn = "uid=".trim($_POST['uid']).",ou=".trim($_POST['ou']).",dc=fjeclot,dc=net";
    $afegirldap = ldap_add($ldapconn, "$dn", $info);
		if($afegirldap) {
			header('Location: usuaricreat.html');
		}
		
		elseif (!$afegirldap){
			header('Location: usuarinocreat.html'); 

		}
     ldap_close($ldapconn);
} else {
	header('Location: redireccioerror.html'); 	
}
}
}
?>