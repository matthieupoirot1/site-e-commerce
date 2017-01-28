<?php

require_once (File::build_path(array("model", "ModelProduit.php")));

class ControllerPanier {
  
    protected static $controller = "panier";
    
    static function ajouterArticle(){
      
       //  && !isVerrouille()
      if(!is_null(routeur::myGet('id')) && !is_null(routeur::myGet('qte')) && !is_null(routeur::myGet('libelle')) && !is_null(routeur::myGet('prix')) && !is_null(routeur::myGet('categorie'))) { // vérifie l'existance de l'id et de la quantité ... etc dans le GET
        $id = routeur::myGet('id');
        $quantite = routeur::myGet('qte');
        $libelle = routeur::myGet('libelle');
        $prix = routeur::myGet('prix');
        $categorie = routeur::myGet('categorie');
        //Si le panier existe
        if(!isset($_SESSION['panier'])){
          $_SESSION['panier']=array();
          $_SESSION['panier']['id'] = array();
          $_SESSION['panier']['libelle'] = array();
          $_SESSION['panier']['quantite'] = array();
          $_SESSION['panier']['prix'] = array();
          $_SESSION['panier']['categorie'] = array();
        }
        $i = array_search($id,  $_SESSION['panier']['id']);
        if ($i !== false){
          $_SESSION['panier']['quantite'][$i] += $quantite ;
        }
        else{
          //Sinon on ajoute le produit
          array_push( $_SESSION['panier']['id'],$id);
          array_push( $_SESSION['panier']['libelle'],$libelle);
          array_push( $_SESSION['panier']['quantite'],$quantite);
          array_push( $_SESSION['panier']['prix'],$prix);
          array_push( $_SESSION['panier']['categorie'],$categorie);
        }
        $data = array(
          'id' => $id,
          'quantite' => $quantite
        );
        $pagetitle = "Article ajouté";
        $view = 'updated';
        if(!ControllerProduit::decremente($data)) {
           $pagetitle = "Page d'erreur";
           $view = 'error';
        }
        require File::build_path(array('view', 'view.php'));
      }else{
        $pagetitle = "Page d'erreur";
        $view = 'error';
        require File::build_path(array('view', 'view.php'));
      }
   }
    
    static function supprimerArticle(){
      //Si le panier existe
      if (isset($_SESSION['panier'])&&!is_null(routeur::myGet('id'))){
      //Nous allons passer par un panier temporaire
        $idProduit = routeur::myGet('id');
        $tmp=array();
        $tmp['id'] = array();
        $tmp['libelle'] = array();
        $tmp['quantite'] = array();
        $tmp['prix'] = array();
        $tmp['categorie'] = array();
        for($i = 0; $i < count($_SESSION['panier']['id']); $i++){
          if ($_SESSION['panier']['id'][$i] !== $idProduit){
            array_push( $tmp['id'],$_SESSION['panier']['id'][$i]);
            array_push( $tmp['libelle'],$_SESSION['panier']['libelle'][$i]);
            array_push( $tmp['quantite'],$_SESSION['panier']['quantite'][$i]);
            array_push( $tmp['prix'],$_SESSION['panier']['prix'][$i]);
            array_push( $tmp['categorie'],$_SESSION['panier']['categorie'][$i]);
          }
          else {
            $quantite = $_SESSION['panier']['quantite'][$i];
          }
        }
        //On remplace le panier en session par notre panier temporaire à jour
        $_SESSION['panier'] =  $tmp;
        //On efface notre panier temporaire
        unset($tmp);
        $tab_panier = $_SESSION['panier'];
        $pagetitle = "Article supprimé";
        $view = 'deleted';
                $data = array(
          'id' => $idProduit,
          'quantite' => (-$quantite)
        );
        if(!ControllerProduit::decremente($data)) {
           $pagetitle = "Page d'erreur";
           $view = 'error';
        }
        require File::build_path(array('view', 'view.php'));
      }
      else{
        $pagetitle = "Page d'erreur";
        $view = 'error';
        require File::build_path(array('view', 'view.php'));
      }   
    }
    
  static function MontantGlobal(){
      $total=0;
      for($i = 0; $i < count($_SESSION['panier']['id']); $i++){
        $total += $_SESSION['panier']['quantite'][$i] * $_SESSION['panier']['prix'][$i];
      }
      return $total;
    }
    
    
    function afficherPanier() {
      if(isset($_SESSION['panier'])){
        $tab_panier = $_SESSION['panier'];
        $pagetitle = "Votre panier";
        $view = "list";
        require File::build_path(array('view', 'view.php'));
      }
      else {
        $pagetitle = "Page d'erreur";
        $view = 'errorPanier';
        require File::build_path(array('view','view.php'));
      }
    }
    
   static function payer() {
        $pagetitle = "Paiement";
        $view = "payment";
        require File::build_path(array('view', 'view.php'));
   }

    /*public static function error(){
        $pagetitle = "Page d'erreur";
        $view='errorPanier';
        $controller='panier';
        require File::build_path(array('view','view.php'));
    }*/
}