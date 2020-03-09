<?php

if(isset($_POST['uid'])&&isset($_POST['ou'])){
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
    $tot = ldap_search($ldapconn, "dc=fjeclot, dc=net","uid=".$usuari);
    
		if($tot) {
			$info = ldap_get_entries($ldapconn, $tot);
			
			if($info['count']==0){
			
			header('Location: errormu.html'); 
		}else{
			for ($i=0; $i<$info['count']; $i++)
			{
				echo "Nom: ".$info[$i]["cn"][0]. "<br />";
				echo "Títol: ".$info[$i]["title"][0]. "<br />";
				echo "Telèfon fixe: ".$info[$i]["telephonenumber"][0]. "<br />";
				echo "Adreça postal: ".$info[$i]["postaladdress"][0]. "<br />";
				echo "Telèfon mòbil: ".$info[$i]["mobile"][0]. "<br />";
				echo "Descripció: ".$info[$i]["description"][0]. "<br />";
				echo "Identificador de l'usuari: ".$info[$i]["uid"][0]. "<br />";
				echo "Numero Identificador del usuari: ".$info[$i]["uidnumber"][0]. "<br />";
				echo "Grupo de l'usuri per defecte: ".$info[$i]["gidnumber"][0]. "<br />";
				echo "Directori personal: ".$info[$i]["homedirectory"][0]. "<br />";
				echo "Shel de l'usuari: ".$info[$i]["loginshell"][0]. "<br />";
				echo "<a href='paginaopcions.html'>Anar menu opscions</a>";
			} 
		}		
		}
		
		 
			
   
} else {
	header('Location: redireccionaerror.html'); 	
}

}

}
?>