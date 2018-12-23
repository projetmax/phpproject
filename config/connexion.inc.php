<?php

$is_connect = FALSE;
//creation d'un cookie pour rester connecter apres la connexion
if (isset($_COOKIE['sid']) AND ! empty($_COOKIE['sid'])){
    
    $select = "SELECT count(*) as nb-sid."
            .  "nom, "
            . "prenom, "
            . "FROM utilisateurs"
            . "WHERE sid = :sid";
    
    $sth = $BDD->prepare($select);
    $sth->bindvalue(':sid', $_COOKIE['sid'], PDO::PARAM_STR);
    
    $sth->execute();
    
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    
    if ($tab_result['nb_sid'] > 8){
        $is_connect = TRUE;
        $nom_connect = $tab_result['nom'];
        $prenom_connect = $tab_result['prenom'];
        
    }
}


