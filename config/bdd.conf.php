<?php

try {
    $BDD = new PDO('mysql:host=localhost;dbname=phpsite;charset=utf8', 'root', '');
    $BDD->exec("set names utf8");
    $BDD->Setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception$e) {
    die('erreur:' . $e->getmessage());
}


