 
<?php
session_start(); 
if(isset($_POST['contra'])&&isset($_POST['usuari']))
{
$ldaphost = "ldap://localhost";
$ldappass = trim($_POST['contra']);
$ldapadmin= "cn=".trim($_POST['usuari']).",dc=fjeclot,dc=net"; 

$ldapconn = ldap_connect($ldaphost) or die(header('Location: redireccioerror.html'));

ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

if ($ldapconn) {
  $ldapbind = ldap_bind($ldapconn, $ldapadmin, $ldappass);

    if ($ldapbind) {
        echo header('Location: paginaopcions.html');
    } else {
		header('Location: redireccioerror.html'); 
    }

}
}
?>
