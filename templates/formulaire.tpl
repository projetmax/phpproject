
<div class="container">
<div class="row">
<div class="col-lg-12 text-center">
    <h1 class = "mt-5">cree un compte</h1> 
</div>
</div>


<div class="row">
<div class="col-lg-12 text-center">
    <form action="formulaire.php" method="post" enctype="multipart/form-data" id="form-compte">
 <div class="form-group">   
     <label for="nom" class="col-form-label">nom</label>
     <input type="text" class="form-control" id="nom" name="nom" placeholder=" votre nom" value=""> 
</div>
        
 <div class="form-group">  
     <label for="prenom">prenom</label>
     <input type ="text" class="form-control" id="prenom" name="prenom" rows="3" required>         
</div>
        
<div class="form-group">  
         <label for="custom-file">
             <input type="text" class="custom-file-input" id="email" name="email">
       <label class="custom-file-label" for="email">
          email</label>
       </label>  
</div>  
        
<div class="form-group">  
<div class="form-group">  
    <label for="mot de passe" class="form-chek-label">
        <input type="texte" class="form-check-input" id="mot de passe" name="mot de passe" value="">mot de passe
    </label>  
</div> 
</div>
    <button type="submit"class="btn btn-primary" name="submit" value="ajouter">cree le compte</button>
  </form>
    </div>
    </div>
    </div>