<?php

if(isset($_POST['uid'])&&isset($_POST['cognom'])&&isset($_POST['titol'])&&isset($_POST['telf'])&&isset($_POST['mbl'])&&isset($_POST['adrss'])&&isset($_POST['desc'])&&isset($_POST['uidN'])&&isset($_POST['gid'])&&isset($_POST['dp'])&&isset($_POST['sp'])&&isset($_POST['psswd'])){
$ldaphost = "ldap://localhost";
$ldappass = "fjeclot";
$ldapadmin= "cn=admin,dc=fjeclot,dc=net"; 


$ldapconn = ldap_connect($ldaphost) or die(header('Location: redireccioerror.html'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

	if ($ldapconn) {

	$ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

		if($ldapbind) {
			$usuari1=trim($_POST['uid']);
			$unitat=trim($_POST['ou']);
			$valor=trim($_POST['valor']);
			$nombre=trim($_POST['nombre']);
			$cognom = trim($_POST['cognom']);
			$titol = trim($_POST['titol']);
			$telf = trim($_POST['telf']);
			$mbl = trim($_POST['mbl']);
			$adrss = trim($_POST['adrss']);
			$desc = trim($_POST['desc']);
			$uidN = trim($_POST['uidN']);
			$gid = trim($_POST['gid']);
			$dp = trim($_POST['dp']);
			$sp = trim($_POST['sp']);
			$psswd = trim($_POST['psswd']);
			$dn = "uid=".$usuari1.",ou=".$unitat.",dc=fjeclot,dc=net" ;
			if($nombre){
				$info["cn"] = trim($_POST['nombre']);
			
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($cognom){
				$info["sn"] = trim($_POST['cognom']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($titol){
				$info["title"] = trim($_POST['titol']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($telf){
				$info["telephonenumber"] = trim($_POST['telf']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($mbl){
				$info["mobile"] = trim($_POST['mbl']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($adrss){
				$info["postaladdress"] = trim($_POST['adrss']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($desc){
				$info["description"] = trim($_POST['desc']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($uidN){
				$info["uidnumber"] = trim($_POST['uidN']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($gid){
				$info["gidnumber"] = trim($_POST['gid']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($dp){
				$info["homedirectory"] = trim($_POST['dp']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($sp){
				$info["loginshell"] = trim($_POST['sp']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			elseif($psswd){
				$info["userpassword"] = trim($_POST['psswd']);
				$modificat = ldap_modify($ldapconn, $dn, $info);
			}
			if($modificat) {
				header('Location: exitusuari.html'); 
			}else{
				header('Location: errorusuari.html'); 
			}
			 ldap_close($ldapconn);
		}else{
			header('Location: redireccioerror.php'); 	
		}
	}
}
?>
