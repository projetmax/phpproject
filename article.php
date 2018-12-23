<?php

session_start();

require_once 'config/init.conf.php';
require_once 'config/BDD.conf.php';
require_once 'config/connexion.inc.php';

include_once 'includes/notification.inc';
include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';
include_once 'includes/mdp.inc.php';

include_once 'libs/Smarty.class.php';

if ($is_connect === FALSE){
   header("location connexion.php");
    
}
                
if(isset($_POST['submit'])){
    
    print_r2($_POST);
    print_r2($_FILES);
    
    $notifications = "";
    
    $publie = isset($_POST['publie']) ? 1 : 0  ;
    
    $date = date("Y-m-d");
    
    if($_POST['submit'] == 'ajouter'){
         $sql_insert = "INSERT INTO articlebdd"
            . "(titre,texte,publie,date)"
            . "VALUES (:titre, :texte, :publie, :date);";
    
$sth = $BDD->prepare($sql_insert);


$sth->bindValue(':titre', $_POST ['titre'], PDO::PARAM_STR);    

$bindValue = $sth->bindValue(':texte', $_POST ['texte'], PDO::PARAM_STR);  

$sth->bindValue(':publie', $publie ['publie'], PDO::PARAM_INT);  

$sth->bindValue(':date', $date ['date'], PDO::PARAM_STR);  
    } else {
        //pour modifier la base de donnees quand on modifie un article
         $sql_insert = "UPDATE articlebdd SET"
                 . "titre = :titre"
                 . "texte = :texte"
                 . "publier = :publier"
                 . "WHERE id =:id";
         
$sth = $BDD->prepare($sql_update);

$sth->bindValue(':titre', $_POST ['titre'], PDO::PARAM_STR);    

$sth->bindValue(':texte', $_POST ['texte'], PDO::PARAM_STR);  

$sth->bindValue(':publier', $publie ['publier'], PDO::PARAM_INT);  

$sth->bindValue(':id', $date ['id'], PDO::PARAM_INT);  
    }

$result = $sth->execute();

 }
   
if('notifications' === TRUE){
    $notifications = 'felicitations votre article a etait insere';
    $result_notification = TRUE;
} else {
$notifications = 'erreur votre article na pas etait insere';    
$result_notification = FALSE;


}

//$notifications = $sth->execute();

if('notifications' == TRUE){}
if($_POST['submit'] === 'ajouter'){
$id_article = $BDD->lastInsertId();

if ($_FILES['image'] ['error'] == 0) {
  $extension = pathinfo($_FILES['image'] ['name'], PATHINFO_EXTENSION);  
  $extension = strtolower($extension);
  
  move_uploaded_file($_FILES['image'] ['tmp_name'] ,'/img' . $id_article . '.' . $extension); 

  $notifications .= $result_img == TRUE? '' : "attention une erreur et survenu lors du deplacement de l'image" ;
}


$_SESSION ['notifications']['message'] = $notifications;
$_SESSION ['notifications']['result'] = $result_notification ;
header("location: index.php");
exit();
}

?>

<?php
//pour modifier ou cree un article

   $actions = $_GET['actions'];
   
   if ($actions == 'ajouter') {
       
       $tab_articles = array(
              'id' => '',
              'titre' => '',
              'texte' => '',
              'publier' => '',
              'date' => '',
           );
   } else {
      $id = $_GET['id'];
      
      $sql_select = "SELECT "
                  . "id, "
                  . "titre, "
                  . "texte, "
                  . "date"
                  . "publie, "
                  . "FROM article"
                  . "WHERE id = :id";
      
$sth = $BDD->prepare($sql_select);

$sth->bindvalue(':publie', 1, PDO::PARAM_INT);

$sth->execute;

$tab_articles = $sth->fetch(PDO::FETCH_ASSOC);
                  
}

$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

//$smarty->debugging = true ;


include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';

 $smarty->display('article.tpl');
 
include_once 'includes/footer.inc.php';



