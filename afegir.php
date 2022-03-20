<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;

	ini_set('display_errors', 0);
	#Dades de la nova entrada
	#
	$uid=$_POST["uid"];
	$unorg=$_POST["uo"];
	$num_id=$_POST["nUID"];
	$grup=$_POST["gUID"];
	$dir_pers=$_POST["dp"];
	$sh=$_POST["shell"];
	$cn=$_POST["cn"];
	$sn=$_POST["sn"];
	$nom=$_POST["nom"];
	$mobil=$_POST["mobile"];
	$adressa=$_POST["adr"];
	$telefon=$_POST["tel"];
	$titol=$_POST["title"];
	$descripcio=$_POST["desc"];
	$objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
	#
	#Afegint la nova entrada
	$domini = 'dc=fjeclot,dc=net';
	$opcions = [
        'host' => 'zend-arolco.fjeclot.net',
		'username' => "cn=admin,$domini",
   		'password' => 'fjeclot',
   		'bindRequiresDn' => true,
		'accountDomainName' => 'fjeclot.net',
   		'baseDn' => 'dc=fjeclot,dc=net',
    ];	
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$nova_entrada = [];
	Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
	Attribute::setAttribute($nova_entrada, 'uid', $uid);
	Attribute::setAttribute($nova_entrada, 'uidNumber', $num_id);
	Attribute::setAttribute($nova_entrada, 'gidNumber', $grup);
	Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir_pers);
	Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
	Attribute::setAttribute($nova_entrada, 'cn', $cn);
	Attribute::setAttribute($nova_entrada, 'sn', $sn);
	Attribute::setAttribute($nova_entrada, 'givenName', $nom);
	Attribute::setAttribute($nova_entrada, 'mobile', $mobil);
	Attribute::setAttribute($nova_entrada, 'postalAddress', $adressa);
	Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telefon);
	Attribute::setAttribute($nova_entrada, 'title', $titol);
	Attribute::setAttribute($nova_entrada, 'description', $descripcio);
	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
	try{
	    $ldap->add($dn, $nova_entrada);
	    echo "Usuari creat";	
	}catch(Exception $error){
	    echo "<b>Aquesta entrada no existeix</b><br><br>";
	}
	echo "<br><br><a href=\"http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/menu.php\">Torna al menú</a>";
?>


<html>
	<head>
		<title>Afegir les dades de l'usuari
		</title>
	</head>
	<body>
		<form action="http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/afegir.php" method="POST">
			UID: <input required type="text" name="uid"><br>
			Unitat Organitzativa: <input required type="text" name="uo"><br>
			UID Num: <input required type="number" name="nUID"><br>
			Grup Num: <input required type="number" name="gUID"><br>
			Directori personal: <input required type="text" name="dp"><br>
			SH: <input required type="text" name="shell"><br>
			CN: <input required type="text" name="cn"><br>
			SN: <input required type="text" name="sn"><br>
			Nom: <input required type="text" name="nom"><br>
			Adressa: <input required type="text" name="adr"><br>
			Mobil: <input required type="text" name="mobile"><br>
			Telefon: <input required type="text" name="tel"><br>
			Titol: <input required type="text" name="title"><br>
			Descripcio: <input required type="text" name="desc"><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
	</body>
</html>
