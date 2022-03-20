<?php
    require'vendor/autoload.php';
    use Laminas\Ldap\Ldap;
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
    $usuari=$ldap->getEntry('uid='.$_GET["uid"].',ou='.$_GET["uo"].',dc=fjeclot,dc=net');
    if(count($usuari)>0){
        echo "<b><u>".$usuari["dn"]."</b></u><br>";
        foreach ($usuari as $atribut => $dada) {
               if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
        }
    }else echo "<b>Aquesta entrada no existeix</b><br><br>";
    echo "<a href=\"http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/menu.php\">Torna al menú</a>";
?>
<html>
	<head>
		<title>Visualitza les dades de l'usuari que vulguis de la base de dades LDAP</title>
	</head>
	<body>
		<form action="http://zend-arolco.fjeclot.net/daw2_m08_uf23_projecte_Olivella_Arnau/visualitza.php" method="GET">
			UID: <input required type="text" name="uid"><br>
			Unitat Organitzativa: <input required type="text" name="uo"><br>
			<input type="submit" value="Envia" />
			<input type="reset" value="Neteja" />
		</form>
		
				<br><br>Tornar al inici <button><a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>
