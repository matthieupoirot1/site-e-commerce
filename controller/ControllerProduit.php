<?php

require_once (File::build_path(array("model", "ModelProduit.php")));

class ControllerProduit {
    protected static $controller = "produit";

    public static function readAll() {
        $view = 'list';
        $pagetitle = 'Liste des produits';
        $tab_produit = ModelProduit::selectAll();
        require File::build_path(array("view", "view.php"));
    }
    
    public static function read() {
        $view = 'detail';
        $pagetitle = 'Détail du produit';
        $p = ModelProduit::select(routeur::myGet('id'));
        require File::build_path(array("view", "view.php"));
    }
    
    public static function search() {
        $tab_produit = ModelProduit::selectByLib(routeur::myGet('libelle'));
        $view = 'list';
        $pagetitle = 'Résultats de la recherche';
        require File::build_path(array("view", "view.php"));
    }
    
    public static function decremente($data){
       if(ModelProduit::updateDecremente($data)) {
           return true;
       }
       return false;
    }
    
    
    
    public static function create(){
        if(Session::isAdmin()){
            $view = 'update';
            $pagetitle = "Enregistrement d'un produit";
            $type='create';
            require  File::build_path(array("view","view.php"));
        }        
    }
    
    public static function created() {
        if(!is_null(routeur::myGet('libelle'))&&!is_null(routeur::myGet('quantite'))&&!is_null(routeur::myGet('prix'))&&!is_null(routeur::myGet('categorie'))) {
            $data = array(
            "libelle" => routeur::myGet('libelle'),
            "quantite" => routeur::myGet('quantite'),
            "prix" => routeur::myGet('prix'),
            "categorie" => routeur::myGet('categorie')
            );
            if((ModelProduit::create($data)) && (!$_FILES['image']['error'] > 0)  && ($_FILES['image']['type'] == "image/png")){
                $_FILES['image']['name'] = str_replace('\'','',str_replace(' ','_',routeur::myGet('libelle')));
                move_uploaded_file($_FILES['image']['tmp_name'],File::build_path(array("image",$_FILES['image']['name'].".png")));
                $controller = 'produit';
                $view = 'created';
                $pagetitle = 'Liste des produits';
                $tab_produit = ModelProduit::selectAll();
                require File::build_path(array("view","view.php"));
            }
            else {
                $controller='produit';
                $pagetitle = "Page d'erreur";
                $view = 'error';
                require File::build_path(array('view', 'view.php'));
        }
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            $controller='produit';
            require File::build_path(array('view', 'view.php'));
        }
    }
    
    public static function update(){
        if(Session::isAdmin()){
            $pagetitle = "Mise à jour du produit";
            $view='update';
            $controller="produit";
            $type='update';
            $p = ModelProduit::select(routeur::myGet('id'));
            require File::build_path(array('view','view.php'));
        }
    }
    
    public static function updated(){
        if($v=ModelProduit::select(routeur::myGet('id'))) {
            $data = array(
                "id" => routeur::myGet('id'),
                "libelle" => routeur::myGet('libelle'),
                "quantite" => routeur::myGet('quantite'),
                "prix" => routeur::myGet('prix'),
                "categorie" => routeur::myGet('categorie')
            );
            if (ModelProduit::update($data)) {
                $pagetitle = "produit mis à jour";
                $view = 'updated';
                $controller='produit';
                $tab_produit = ModelProduit::selectAll();
                require File::build_path(array('view', 'view.php'));
            } else {
                $controller='produit';
                $pagetitle = "Page d'erreur";
                $view = 'error';
                require File::build_path(array('view', 'view.php'));
            }
        } else {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            $controller='produit';
            require File::build_path(array('view', 'view.php'));
        }
    }
    
    public static function error(){
        $pagetitle = "Page d'erreur";
        $view='error';
        $controller='produit';
        require File::build_path(array('view','view.php'));
    }
    
    public static function delete(){
        if(Session::isAdmin()){
            if(ModelProduit::delete(routeur::myGet('id'))){
                $pagetitle = 'Produit supprimé';
                $view='deleted';
                $controller ='produit';
                $tab_produit=ModelProduit::selectAll();
                require File::build_path(array('view','view.php'));
            }
            else{
                $pagetitle = "Page d'erreur";
                $view='error';
                $controller='produit';
                require File::build_path(array('view','view.php'));
            }
        }
    }
    
}
