<?php

require_once File::build_path(array('model','ModelUtilisateur.php')); // chargement du modèle
require_once File::build_path(array('lib','Security.php'));
require_once File::build_path(array('lib','Session.php'));


class ControllerUtilisateur
{
    protected static $controller = 'utilisateur';

    public static function readAll() {
        $tab_utilisateur = ModelUtilisateur::selectAll();     //appel au modèle pour gerer la BD
        $pagetitle = 'Liste des utilisateurs';
        $view = 'list';
        require File::build_path(array('view','view.php'));  //"redirige" vers la vue
    }

    public static function read() {
        $u = ModelUtilisateur::select(routeur::myGet('login'));
        if (!$u) {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }
        else {
            $pagetitle = "Détail de l'utilisateur";
            $view = 'detail';
            require File::build_path(array('view','view.php'));
        }

    }
    
    public static function update(){
        $u = ModelUtilisateur::select(routeur::myGet('login'));
        if(!$u) {
            $pagetitle = "Page d'erreur";
            $view = 'error';
            require File::build_path(array('view','view.php'));
        }
        else {
            if((isset($_SESSION['login'])&&($_SESSION['login']==routeur::myGet('login')))||Session::isAdmin()){
                $pagetitle = "Mise à jour utilisateur";
                $view = "update";
                $type = "update";
                require File::build_path(array('view','view.php'));
            }
            else {
                 $pagetitle = "Connexion";
                 $view = 'connect';
                 require File::build_path(array('view','view.php'));
            }
        }
    }
    
    public static function updated(){
        if(isset($_SESSION['login'])){
            if($_SESSION['login']==routeur::myGet('login')||Session::isAdmin()){                 
                if(ModelUtilisateur::select(routeur::myGet('login'))){
                    
                    $data = array(
                        "login" => routeur::myGet('login'),
                        "nom" => routeur::myGet('nom'),    
                        "prenom" => routeur::myGet('prenom'),
                        "mail" => routeur::myGet('mail')
                    );
                    if(routeur::myGet('mdp')!=""){
                        $data['mdp']=Security::chiffrer(routeur::myGet('mdp'));
                    }else{
                        $data['mdp']=ModelUtilisateur::select(routeur::myGet('login'))->getMdp();
                    }
                    if(Session::isAdmin()){
                        $data['admin']=routeur::myGet('admin');
                    }
                    if (ModelUtilisateur::update($data)){
                    
                        $pagetitle = "Utilisateur modifié";
                        $view = 'updated';
                        $tab_utilisateur = ModelUtilisateur::selectAll();
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
        }
        else {
                 $pagetitle = "Connexion";
                 $view = 'connect';
                 require File::build_path(array('view','view.php'));
        }
        
    }
    
    public static function create(){
        
            $pagetitle = "Enregistrer utilisateur";
            $view = "update";
            $type = "create";
            require File::build_path(array('view','view.php'));
    }
    
    public static function created(){
        $data = array(
            "login" => routeur::myGet('login'),
            "mdp" => Security::chiffrer(routeur::myGet('mdp')),
            "nom" => routeur::myGet('nom'),    
            "prenom" => routeur::myGet('prenom'),
            "mail" => routeur::myGet('mail')
        );
        if(ModelUtilisateur::create($data)){
            if(filter_var($data['mail'],FILTER_VALIDATE_EMAIL)!=false){
                $uniqueNonce = Security::generateRandomHex();
                $mail='Cliquez sur <a href="http://infolimon.iutmontp.univ-montp2.fr/~bretone/eCommerce/Projet/index.php?action=validate&login='.$data['login'].'&controller=utilisateur&nonce='.$uniqueNonce.'">ce lien</a> pour valider votre inscription à Vendestrucs !';
                ModelUtilisateur::initNonce($data['login'],$uniqueNonce);
                $pagetitle = "Utilisateur enregistré";
                $view = "created";
                $tab_utilisateur = ModelUtilisateur::selectAll();
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
    
    public static function delete(){
        if((isset($_SESSION['login'])&&($_SESSION['login']==routeur::myGet('login')))||Session::isAdmin()){
            session_destroy();
            ModelUtilisateur::delete(routeur::myGet('login'));
            $pagetitle = "Utilisateur supprimé";
            $view = "deleted";
            $tab_utilisateur = ModelUtilisateur::selectAll();
            session_start();
            require File::build_path(array('view', 'view.php'));
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'erreur';
            require File::build_path(array('view','view.php'));
        }
    }
    
    public static function connect(){
        $pagetitle="Connexion";
        $view ="connect";
        require File::build_path(array('view', 'view.php'));
    }
    
    public static function connected(){
        $data = array(
            "login" => routeur::myGet('login'),
            "mdp_chiffre" => Security::chiffrer(routeur::myGet('mdp'))
        );
        if(ModelUtilisateur::checkPassword($data['login'],$data['mdp_chiffre'])){
            if(ModelUtilisateur::select($data['login'])->getNonce()==NULL){
                if(ModelUtilisateur::select($data['login'])->getAdmin()){
                    $_SESSION['admin'] = true;
                }
            $_SESSION['login'] = $data['login'];
            $pagetitle = "Bienvenue";
            $u = ModelUtilisateur::select($data['login']);
            $view = "detail";
            require File::build_path(array('view','view.php'));
            }
            else {
                $pagetitle = "Page d'erreur";
                $view = 'errorValidate';
                require File::build_path(array('view','view.php'));
            }
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'errorLogin';
            require File::build_path(array('view','view.php'));
        }
    }
    
    public static function deconnect(){
        session_destroy();
        $pagetitle = "Déconnexion";
        $view = "deconnected";
        session_start();
        require File::build_path(array('view','view.php'));
    }
    
    public static function validate() {
        
        if(routeur::myGet('login')!=NULL && routeur::myGet('nonce')!=NULL) {
            $data = array(
                "login" => routeur::myGet('login'),
                "nonce" => routeur::myGet('nonce')
            );
            $u = ModelUtilisateur::select($data['login']);
            if($u != false && $u->getNonce() == $data['nonce']) {
                ModelUtilisateur::setNonceToNull($data['login']);
                $pagetitle = "Inscription validée";
                $view = 'validated';
                require File::build_path(array('view','view.php'));
            }
        }
        else {
            $pagetitle = "Page d'erreur";
            $view = 'erreur';
            require File::build_path(array('view','view.php'));
        }
    }
}