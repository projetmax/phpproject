<?php
session_start();

require_once 'config/init.conf.php';
require_once 'config/bdd.conf.php';
require_once 'config/connexion.inc.php';

include_once 'includes/header.inc.php';
include_once 'includes/header.inc.php';
include_once 'includes/mdp.inc.php';

?>

 <?php
 $page_courante = empty($p) ? 1 : $p;
 
 $index = getindex($page_courante, _nb_arti_par_page);
      
/* @var $recherche type */
/* @var $nb_article type */ 
$nb_article = nb_total_article_publie_recherche( $recherche , $BDD );
 
 $nb_page =ceil($nb_article/ $nb_article_par_page);
 
$select_articles = "SELECT "
                  . "id, "
                  . "titre, "
                  . "texte, "
                  . "date_FORMAT(date, '%d/%m%y')"
                  . "publier, "
                  . "WHERE publier = 1"
                  . "AND (titre LIKE :recherche OR texte LIKE :recherche"
                  . "LIMIT index, :nb_article_par_pages";


$sth = $BDD->prepare($select_articles);

$sth->bindvalue(':publier ', 1, PDO::PARAM_BOOL);
$sth->bindvalue(':nb_article_par_page ', nb_arti_par_page, PDO::PARAM_INT);
$sth->bindvalue(':index ', $index, PDO::PARAM_INT);
$sth->bindvalue(':recherche', '%' , $recherche , '%' , PDO::PARAM_STR);


$sth->execute();
$tab_articles = $sth->fetch(PDO::FETCH_ASSOC);
//print_r2($tab_articles);


?> 
<div class="container">
<div class="row">
<div class="col-lg-12 text-center">
    <h1 class = "mt-5">recherche article</h1> 
</div>
</div>


<div class="row">
<div class="col-lg-12 text-center">
    <form action="formulaire.php" method="post" enctype="multipart/form-data" id="form-compte">
 <div class="form-group">   
     <label for="nom" class="col-form-label">recherche</label>
     <input type="text" class="form-control" id="nom" name="nom" placeholder=" votre nom" value=""> 
</div>
        
<?php

include_once 'footer.inc.php';

?>
