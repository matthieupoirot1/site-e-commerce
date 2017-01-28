<?php

require_once (File::build_path(array("model", "Model.php")));

class ModelProduit extends Model{

    private $id;
    private $libelle;
    private $quantite;
    private $prix;
    private $categorie;
    protected static $object = "produit";
    protected static $primary = "id";
    
    function getId() {
        return $this->id;
    }

    function getLibelle() {
        return $this->libelle;
    }

    function getQuantite() {
        return $this->quantite;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    function setQuantite($quantite) {
        $this->quantite = $quantite;
    }
    
    function setPrix($value){
        $this->prix = $value;
    }
    
    function getPrix(){
        return $this->prix;
    }
    
    function setCategorie($categorie) {
        $this->categorie=$categorie;
    }
    
    function getCategorie(){
        return $this->categorie;
    }
    
    function updateDecremente($data){
        $requete = 'UPDATE p_produit SET quantite=quantite-:q WHERE id=:id';
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":q" => $data['quantite'],
            ":id" => $data['id'],
        );
        try{
            $requete_prepare->execute($values); 
            return true;
        }
        catch(PDOException $e){
            $e->getMessage();
            return false;
        }
    }
    
    function __construct($id = NULL, $libelle = NULL, $quantite = NULL, $prix = NULL, $categorie = NULL) {
        if (!is_null($id) && !is_null($libelle) && !is_null($quantite) &&!is_null($prix) && !is_null($categorie)) {
            $this->id = $id;
            $this->libelle = $libelle;
            $this->quantite = $quantite;
            $this->prix = $prix;
            $this->categorie = $categorie;
        }
    }
    
     public static function selectByLib($value){
        $requete = 'SELECT * FROM p_produit WHERE libelle LIKE :lib';
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":lib" => '%'.$value.'%',
        );
        try{
            $requete_prepare->execute($values); 
            $requete_prepare->setFetchMode(PDO::FETCH_CLASS, 'ModelProduit');
            $tab = $requete_prepare->fetchAll();
        }
        catch(PDOException $e){
            $e->getMessage();
        }
        if (empty($tab)) {
            return false;
        }
        return $tab;
    }
}
