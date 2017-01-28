<?php

/**
 * Created by PhpStorm.
 * User: matthieuPOIROT
 * Date: 12/11/2016
 * Time: 01:02
 */
require_once File::build_path(array('model','Model.php')); // chargement du modèle

class ModelUtilisateur extends Model
{
    private $login;
    private $nom;
    private $prenom;
    private $mdp;
    private $mail;
    private $admin;
    private $nonce;
    protected static $object = "utilisateur";
    protected static $primary = "login";

    /**
     * Utilisateur constructor.
     * @param $login
     * @param $nom
     * @param $prenom
     */
    public function __construct($login = NULL, $nom = NULL, $prenom = NULL, $mdp = NULL, $mail = NULL, $admin = NULL, $nonce = NULL)
    {
        if(!is_null($login) && !is_null($nom) && !is_null($prenom) &&!is_null($mdp) &&is_null($mail) &&!is_null($admin) && !is_null($nonce)) {
            $this->login = $login;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->mdp = $mdp;
            $this->mail = $mail;
            $this->admin = $admin;
            $this->nonce = $nonce;
        }
    }

    public function getLogin()
    {
        return $this->login;
    }
    
    public function setLogin($login)
    {
        $this->login = $login;
    }
    
    public function getAdmin() {
        return $this->admin;
    }
    
    public function getNonce() {
        return $this->nonce;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }
    
    public function getMdp(){
        return $this->mdp;
    }
    
     public function setMail($mail)
    {
        $this->mail = $mail;
    }
    
    public function getMail(){
        return $this->mail;
    }

    public static function checkPassword($login,$mot_de_passe_chiffre){
        
        $requete = "SELECT COUNT(*) FROM p_utilisateur WHERE login=:log AND mdp=:mdp";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":log" => $login,
            ":mdp" => $mot_de_passe_chiffre
        );
        try {
            $requete_prepare->execute($values);
            $requete_prepare->setFetchMode(PDO::FETCH_NUM);
            $nbreIteration = $requete_prepare->fetch();
            if($nbreIteration[0] == 1) {
                return true;
            }
            else{
                return false;
            }
        }
        catch(PDOException $e){
            return false;
        }
    }
    
    /*public static function checkNonce($login,$mot_de_passe_chiffre) {
        $class_name="ModelUtilisateur";
        $requete = "SELECT * FROM p_utilisateur WHERE login= :log and mdp= :mdp";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":log" => $login,
            ":mdp" => $mot_de_passe_chiffre
        );
        try {
            $requete_prepare->execute($values);
            $requete_prepare->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $user = $requete_prepare->fetch();
            if($user->getNonce() != NULL) {
                echo 'pas d\'erreur getNonce';
                return false;
            }
            else{
                echo 'erreur getNonce';
                return true;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }*/
    
    public static function setNonceToNull($login) {
        $class_name="ModelUtilisateur";
        $requete = "UPDATE p_utilisateur SET nonce =NULL WHERE login= :log";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":log" => $login
        );
        try {
            $requete_prepare->execute($values);
            return true;
        }
        catch(PDOException $e){
            return false;
        }
    }
        
    public static function initNonce($login,$nonce) {
        $class_name="ModelUtilisateur";
        $requete = "UPDATE p_utilisateur SET nonce = :nonce WHERE login=:log";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":nonce" => $nonce,
            ":log" => $login
        );
        try {
            $requete_prepare->execute($values);
            return true;
        }
        catch(PDOException $e){
            return false;
        }
    }
}