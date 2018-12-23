<div class="container">
<div class="row">
<div class="col-lg-12 text-center">
    <h1 class = "mt-5"><?= ucfirst($actions) ?> un article</h1> 
</div>
</div>


<div class="row">
<div class="col-lg-12 text-center">
    <input type="hidden"  value="<?= $tab_articles['id'] ?>" name="id">
    <form action="article.php" method="post" enctype="multipart/form-data" id="form-article">
 <div class="form-group">   
     <label for="titre" class="col-form-label">titre</label>
     <input type="text" class="form-control" id="titre" name="titre" placeholder="titre de votre article" value="<?= $tab_articles['titre'] ?>" required=""> 
</div>
        
 <div class="form-group">  
     <label for="text">texte</label>
     <textarea class="form-control" id="text" name="texte" rows="3" required><?= $tab_articles['texte'] ?></textarea>              
</div>
        
<div class="form-group">  
         <label for="custom-file">
       <input type="file" class="custom-file-input" id="image" name="image">
       <label class="custom-file-label" for="image">
           choissir un fichier</label>
       </label>  
</div>  
        
<div class="form-group">  
  
    <label for="publie" class="form-chek-label">
        <input type="checkbox" class="form-check-input" id="publie" name="publie" value="1" <?php if ($tab_articles['publie'] == 1){ ?> checked<?php } ?>>publie?
     </label>  
 
</div>
    <button type="submit" class="btn btn-primary" name="submit" value="<?= $actions ?>"><?= ucfirst($actions) ?> l'article</button>
  </form>
    </div>
    </div>
    </div>