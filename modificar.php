
<?php
	require 'vendor/autoload.php';
	use Laminas\Ldap\Attribute;
	use Laminas\Ldap\Ldap;
	
	ini_set('display_errors', 0);
	#
	# Entrada a modificar
	#
	$uid = $_POST["uid"];
	$unorg = $_POST["uo"];
	$dn = 'uid='.$uid.',ou='.$unorg.',dc=fjeclot,dc=net';
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
	# Modificant l'entrada
	#
	$ldap = new Ldap($opcions);
	$ldap->bind();
	$entrada = $ldap->getEntry($dn);
	if ($entrada){
	    if($_POST["atribut"]== 'uidNumber' || $_POST["atribut"]== 'gidNumber' ){
	      Attribute::setAttribute($entrada,$_POST["atribut"],(int)$_POST["atr"]);
		  $ldap->update($dn, $entrada);
	    }else{
	        Attribute::setAttribute($entrada,$_POST["atribut"],$_POST["atr"]);
	        $ldap->update($dn, $entrada);
	    }
		echo "Atribut modificat"; 
	} else echo "<b>Aquesta entrada no existeix</b><br><br>";	
	echo "<br><br><a href=\"http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/menu.php\">Torna al menú</a>";
?>

<html>
	<head>
		<title>Modifica els camps d'un usuari de la base de dades LDAP</title>
	</head>
	<body>
		<form action="http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/modificar.php" method="GET">
			UID: <input required type="text" name="uid"><br>
			Unitat Organitzativa: <input required type="text" name="uo"><br>
			<fieldset>
        		<legend>Escull un atribut:</legend>
        		<label><input checked type="radio" name="atribut" value="uidNumber">UID Num</label>
        		<label><input type="radio" name="atribut" value="gidNumber">Grup Num</label>
        		<label><input type="radio" name="atribut" value="homeDirectory">Directori personal</label>
        		<label><input type="radio" name="atribut" value="loginShell">SH</label>
        		<label><input type="radio" name="atribut" value="cn">CN</label>
        		<label><input type="radio" name="atribut" value="sn">SN</label>
        		<label><input type="radio" name="atribut" value="givenName">Nom</label>
        		<label><input type="radio" name="atribut" value="postalAdress">Adressa</label>
        		<label><input type="radio" name="atribut" value="mobile">mobile</label>
        		<label><input type="radio" name="atribut" value="telephoneNumber">telefon</label>
        		<label><input type="radio" name="atribut" value="title">titol</label>
        		<label><input type="radio" name="atribut" value="description">descripcio</label>
			</fieldset>
			Introdueix l'atribut excollit: <input required type="text" name="atr"><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
		
				<br><br>Tornar al inici <button><a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>
