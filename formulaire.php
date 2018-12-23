<?php
    
session_start();

require_once 'config/init.conf.php';
require_once 'config/BDD.conf.php';
require_once 'config/connexion.inc.php';

include_once 'includes/mdp.inc.php';
include_once 'includes/notification.inc';

include_once 'libs/Smarty.class.php';

if ($is_connect = TRUE){
     header("location article.php");
   
}

if(isset($_POST['submit'])){
    
    //print_r2($_POST);
    //print_r2($_FILES);
    
    $notifications ;
    
    $publie = isset($_POST['publie']) ? 1 : 0  ;
    
    $date = date("Y-m-d");

$sql_insert = "INSERT INTO compte"
            ."(nom,prenom,email,mdp)"
            ."VALUES (:nom, :prenom, :email, :mdp);";
    
$sth = $BDD->prepare($sql_insert);


$sth->bindValue(':nom', $_POST ['nom'], PDO::PARAM_STR);    

$sth->bindValue(':prenom', $_POST ['prenom'], PDO::PARAM_STR);  

$sth->bindValue(':email', $_post['email'], PDO::PARAM_INT);  

$sth->bindValue(':mdp', cryptpassword($_post['mdp']), PDO::PARAM_STR);  

} 
if ('notifications' == TRUE){
    
    $notifications = 'felicitations votre counte a etait cree';
    $result_notification = TRUE;
} else {
$notifications = 'erreur votre article na pas etait insere';    
$result_notification = FALSE;
}
//$notifications = $sth->execute();

if('notifications' == TRUE){

$id_article = $BDD->lastInsertId();

if ($_FILES['image'] ['error'] == 0) {
  $extension = pathinfo($_FILES['image'] ['name'], PATHINFO_EXTENSION);  
  $extensions = strtolower($extension);
  
  move_uploaded_file($_FILES['image'] ['tmp_name'] ,'/img' . $id_article . '.' . $extension); 

  $notifications = $result_img == TRUE? '' : "attention une erreur et survenu lors du deplacement de l'image" ;
}

$_SESSION ['notifications']['message'] = $notifications;
$_SESSION ['notifications']['result'] = $result_notification ;
header("location: index.php");
exit();
}
$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

//$smarty->debugging = true ;


include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';

 $smarty->display('formulaire.tpl');
 
include_once 'includes/footer.inc.php';

?>


