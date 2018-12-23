<?php


function cryptpassword($mdp ) {
    
    $mdp_crypt = sha1($mdp);
    
    return $mdp_crypt;
}

function sid($email) {
    $sid = md5 ($email , time());
    return $sid;
    
}

function getindex($page_courante , $nb_articles_par_page){
    
    $index = ($page_courante - 1) * $nb_articles_par_page;
    return $index;
}
//function pour compter le nombre d'article publier
function nb_total_article_publie($BDD){
    
    $sql = "SELECT COUNT(*) as nb_total_article_publie "
         . "FROM articlebdd "
         . "WHERE publier =1";
    
    $sth = $BDD->prepare($sql);
    $sth->execute();
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    
    return $tab_result['nb_total_article_publie'];
    
}
//function pour compter le nombre d'article publier en rapport avec la recherche
function nb_total_article_publie_recherche($recherche , $BDD){
    /* @var $BDD PDO */
    $sql = "SELECT COUNT(*) as nb_total_article_publie "
         . "FROM articlebdd "
         . "WHERE (titre LIKE :recherche OR texte LIKE :recherche "
         . "AND publier =1" ;
    
    $sth = $BDD->prepare($sql);
    $sth->bindvalue(':recherche', '%' , $recherche , '%' , PDO::PARAM_STR);
    $sth->execute();
    $tab_result = $sth->fetch(PDO::FETCH_ASSOC);
    
    return $tab_result['nb_total_article_publie'];
    
}
/* 
 * Copyright (C) 2018 acer
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

