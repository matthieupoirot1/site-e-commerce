<?php

require_once (File::build_path(array("model", "ModelCommande.php")));
require_once File::build_path(array("lib", "Session.php"));
class ControllerCommande{
    
    protected static $controller = "commande";
  
  public static function readAll() {
        if(Session::isAdmin()) {
            $tab_commande = ModelCommande::selectAll();     //appel au modèle pour gerer la BD
            $pagetitle = 'Liste des commandes';
            $view = 'list';
            if(!is_array($tab_commande)){
                $pagetitle = "Page d'erreur";
                $view = 'error';
            }
            require File::build_path(array('view','view.php'));
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }
    }
    
      public static function readAllByUser(){

        if(Session::isUser(routeur::myGet('login'))||Session::isAdmin()) {
            $tab_commande = ModelCommande::selectByUser($_SESSION['login']);     //appel au modèle pour gerer la BD
            $pagetitle = 'Historique des commandes';
            $view = 'historique';
            require File::build_path(array('view','view.php'));
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));            
        }
    }

    public static function read() {
      if(Session::isUser(routeur::myGet('login'))||Session::isAdmin()) {
            $tab_commande = ModelCommande::selectById(routeur::myGet('id'));     //appel au modèle pour gerer la BD
            $pagetitle = 'Détail de la commande';
            $view = 'detail';
            require File::build_path(array('view','view.php'));
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));            
        }
    }
    
    public static function update(){
        if(Session::isAdmin()){
            $c = ModelCommande::select(routeur::myGet('id_cmd'));
            if(!$c) {
                $pagetitle = "Page d'erreur";
                $view = 'error';
                require File::build_path(array('view','view.php'));
            }
            else {
                if(Session::isUser($c->getClient())||Session::isAdmin()) {
                    $pagetitle = "Mise à jour commande";
                    $view = "update";
                    $type = "update";
                    require File::build_path(array('view','view.php'));
                }
            }
        }
    }
    
    public static function updated(){
        if((ModelCommande::select(routeur::myGet('id_cmd')))&&Session::isAdmin()){ 
            $data = array(
                "id_cmd" => routeur::myGet('id_cmd'),
                "date_cmd" => routeur::myGet('date_cmd'),    
                "client_login" => routeur::myGet('client_login')
            );
            if (ModelCommande::update($data)){
                
                $pagetitle = "Commande modifié";
                $view = 'updated';
                $tab_commande = ModelCommande::selectAll();
                require File::build_path(array('view', 'view.php'));
            }
            else {
                $pagetitle = "Page d'erreur";
                $view = 'error';
                require File::build_path(array('view','view.php'));
            }
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }
        
    }

    public static function create(){
        $date = date('Y-m-j');
        $dataCommande = array(
            'date_cmd' => $date,
            'client_login' => $_SESSION['login']
        );
        $dataProduit = array();
        for($i = 0; $i < count($_SESSION['panier']['id']); $i++){
            $dataProduit[$i]['idProduit'] = $_SESSION['panier']['id'][$i];
            $dataProduit[$i]['quantite'] = $_SESSION['panier']['quantite'][$i];
        }
        if(ModelCommande::enregistrerCommande($dataCommande,$dataProduit)) {
            $pagetitle = "Enregistrer commande";
            $view = "created";
            require File::build_path(array('view','view.php'));
            unset($_SESSION['panier']);
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }
    }
    
    public static function delete(){
        if(Session::isAdmin()) {
             ModelCommande::delete(routeur::myGet('id_cmd'));
             $pagetitle = "Commande supprimé";
             $view = "deleted";
             $tab_commande = ModelCommande::selectAll();
        require File::build_path(array('view', 'view.php'));
        }
    }
  
}