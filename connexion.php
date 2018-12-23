<?php
session_start();

require_once 'config/init.conf.php';
require_once 'config/BDD.conf.php';
require_once 'config/connexion.inc.php';

include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';
include_once 'includes/mdp.inc.php';

    $sql_insert = "select count(*) as total"
            ."FROM utilisateurs)"
            ."WHERE email = :email;"
            ."AND mdp= :mdp" ;
    
$sth = $bdd-> prepare($sql_select_count);


$sth->bindValue(':email', $_POST ['email'], PDO::PARAM_STR);    

$sth->bindValue(':mdp', cryptpassword($_POST['mdp']), PDO::PARAM_STR);  

 

$notifications = $sth->execute();

$nb_result = $sth->fetch(PDO::FETCH_ASSOC);

if( $nb_result['total'] > 0){
    
    $sid = sid( $_post['email']);
    echo $sid;
    $sql_update = "UPDATE utilisateurq"
            . "SET sid = :sid ;"
            . "WHERE email = :email ;";
    
    $sth_update = $bdd->prepare($sql_update);
    
$sth->bindValue(':email', $_POST ['email'], PDO::PARAM_STR);    

$sth->bindValue(':sid', $sid, PDO::PARAM_STR);  

$result_update = $sth_update->execute();

//var_dump($result_update);

    setcookie('sid', $sid, time() + 86400);
}



 if($notifications == TRUE){
    $notifications = 'vous etes connecter';
    $result_notification = TRUE;
} else {
$notifications = 'erreur mauvais mot de passe ou mauvais identifiant';    
$result_notification = FALSE;

$_SESSION ['notifications']['message'] = $notifications;
$_SESSION ['notifications']['result'] = $result_notification ;

$result_notification == TRUE ? header("location index.php") : header("location :index.php");
exit();
}

if (isset($_SESSION['notifications'])){
    $color_notifications = $_SESSION['notifications']['result'] == TRUE ? 'succes' : 'danger';
    
    
}
?>

