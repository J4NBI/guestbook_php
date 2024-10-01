<?php

try {

    $pdo = new PDO('mysql:host=sql8.freesqldatabase.com;port=3306;dbname=sql8734552', 'sql8734552', 'nCBPVcaLuF', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    // $pdo = new PDO('mysql:host=localhost;dbname=php_guestbook', 'root', '', [
    //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    // ]);
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}

