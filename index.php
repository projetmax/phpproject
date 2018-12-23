<?php
session_start();
require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
require_once 'config/connexion.inc.php';

include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';
include_once 'includes/mdp.inc.php';

//
if (isset($_SESSION['notifications'] )){
    $color_notifications = $_SESSION ['notifications']['message'] == TRUE ? 'succes': 'danger';
}
?>


<div class="container"></div> 
<div class="row">
<div class="col-lg-12 text-center">
    <h1 class = "mt-4">Mon super blog</h1> 
    
    <?php if( isset($_SESSION['notifications'] )){     ?>
    <div class="alert <?= $color_notifications ?> alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
 <?= $_SESSION ['notifications']['message'] ;?>
    <?php unset($_SESSION['notifications']); ?>
</div>                  
    <?php } ?>
</div>           
   
 <?php
//<-------------body--------------------------->
 $page_courante = empty($_GET['p']) ? 1 : $_GET['p'];
 
 $index = getindex($page_courante , _nb_arti_par_page);
      
 $nb_article = nb_total_article_publie($BDD);
 
 $nb_page = ceil($nb_article/ _nb_arti_par_page);
 
$select_articles = "SELECT "
                  . "id, "
                  . "titre, "
                  . "texte, "
                  . "DATE_FORMAT(date, '%d/%m%y') as date_fr, "
                  . "publier "
                  . "FROM articlebdd "
                  . "WHERE publier = :publier "
                  . "LIMIT :index, :nb_article_par_pages";

$sth = $BDD->prepare($select_articles);

$sth->bindvalue(':publier ', 1, PDO::PARAM_BOOL);
$sth->bindvalue(':nb_article_par_pages ', _nb_arti_par_page, PDO::PARAM_INT);
$sth->bindvalue(':index ', $index, PDO::PARAM_INT);

$sth->execute();
$tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);
//print_r2($tab_articles);


?> 
    </div>
<div class="row">
    
<?php 
foreach ($tab_articles as $key => $VALUE )
{
?>    
<div class="col-md-6">
<div class="card-mt-4 ">
    <img class="card-img-top" src="" <?php $VALUE['id'] ?> alt="">
<div class="card-body ">
    <h4 class="card-title"><?php $VALUE['titre'] ?> </h4>
        <p class="card-text"><?php $VALUE['texte'] ?> </p>
        <a href="" class="btn btn-primary"> cree le: <?php $VALUE['date'] ?> </a>
        
        <a href="article.php?action_modifier$id" <?php $VALUE['id'] ?>class="btn btn-warning"> Modifier  </a>
 
   </div>
  </div>
 </div>

<?php

}
/*
?>//pagination
</div>
<div class="row">
    <nav aria-label="page navigation example" class="mx-auto mt-4">

        <ul class="pagination">
             
       <?php
for ($i = 1; $i <= $nb_page; $i++) {   
?>
            <li class="page-item">
          
            </li>
            </ul>
    
    </nav>
</div>


<?php
for ($i = 1; $i <= $nb_page; $i++) {

 echo "<a href='?p=$i'>page $i</a>";   
*/

   
include_once 'includes/footer.inc.php';
?>


