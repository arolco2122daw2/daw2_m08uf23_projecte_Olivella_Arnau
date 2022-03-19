<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;
    
    ini_set('display_errors', 0);
    #
    # Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
    #
    if ($_GET['usr'] && $_GET['ou']){
        $uid = $_GET['usr'];
        $unorg = $_GET['ou'];
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
        # Esborrant l'entrada
        #
        $ldap = new Ldap($opcions);
        $ldap->bind();
        if ($ldap->delete($dn))	echo "<b>Entrada esborrada</b><br>";
    }else echo "<b>Aquest usuari no existeix</b><br><br>";
    
?>

<html>
	<head>
		<title> Elimina l'usuari que vulguis de la base de dades LDAP</title>
	</head>
	<body>
		<form action="http://zend-arolco.fjeclot.net/projecte_olivella/eliminar.php" method="GET">
			Usuari: <input type="text" name="usr"><br>			
            Unitat organitzativa: <input type="text" name="ou"><br>
			<input type="submit"/>
		</form>
		
				<br><br>Tornar al inici <button> <a href="menu.php">INICI</a></button> <br><br>
		
	</body>
</html>
