<?php

/*try {                                                       // Dieser Nutzer hat nur Zugriff auf folgende Datenbank
    $pdo = new PDO('mysql:host=localhost;dbname=php_gallery', 'php_gallery', 'ev13SQ(A(qwQg!l*', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}*/

//var_dump($pdo);

require_once __DIR__ . '/phptoolconf.php';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$username", "$password", [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...' . $e->getMessage();
    die();
}
