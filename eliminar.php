<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	#
	# Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
	#
	$uid = 'usr3';
	$unorg = 'usuaris';
	$dn = 'uid='.$_POST["uid"].',ou='.$_POST["uo"].',dc=fjeclot,dc=net';
	#
	#Opcions de la connexió al servidor i base de dades LDAP
	$opcions = [
		'host' => 'zend-arolco.fjeclot.net',
		'username' => 'cn=admin,dc=fjeclot,dc=net',
		'password' => 'fjeclot',
		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
		'baseDn' => 'dc=fjeclot,dc=net',		
	];
	#
	# Esborrant l'entrada
	#
	$ldap = new Ldap($opcions);
	$ldap->bind();
	try{
	    $ldap->delete($dn);
	    echo "<b>Entrada esborrada</b><br>"; 
	}catch(Exception $error){
	   echo "<b>Aquesta entrada no existeix</b><br>";
	}
	echo "<a href=\"http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/menu.php\">Torna al menú</a>";
?>

<html>
	<head>
		<title> Elimina l'usuari que vulguis de la base de dades LDAP</title>
	</head>
	<body>
		<form action="http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/eliminar.php" method="GET">
			UID: <input required type="text" name="uid"><br>
			Unitat Organitzativa: <input required type="text" name="uo"><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
		
				<br><br>Tornar al inici <button> <a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>
