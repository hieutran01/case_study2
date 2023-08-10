<?php
    define('ROOT_URL','http://localhost/QLTV/');
    define('ROOT_DIR', dirname(__FILE__) );

    $username   = 'root';
    $password   = '';
    $database   = 'quanlytthuvien';
    try {
        $conn = new PDO('mysql:host=localhost;dbname='.$database, $username, $password);
    } catch (Exception $e) {
        // echo $e->getMessage();
        echo '<h1>Khong the ket noi CSDL</h1>';
    }   