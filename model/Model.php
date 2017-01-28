<?php

require_once (File::build_path(array("config", "Conf.php")));

class Model {

    public static $pdo;
    protected static $object;

    public static function Init() {
        $hostname = conf::getHostname();
        $database_name = conf::getDatabase();
        $login = conf::getLogin();
        $password = conf::getPassword();

        try {
// Connexion à la base de données            
// Le dernier argument sert à ce que toutes les chaines de caractères 
// en entrée et sortie de MySql soit dans le codage UTF-8
            self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
// On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage(); // affiche un message d'erreur
            die();
        }
    }
    
    public static function selectAll(){
        $table_name = "p_".static::$object;
        $class_name = "Model".ucfirst(static::$object);
        $requete = "SELECT * FROM $table_name";
        $rep = Model::$pdo->query($requete);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        try {
            $tab = $rep->fetchAll();
            return $tab;
        }catch(PDOException $e){
            return false;
        }
        
    }

    public static function select($value){
        $table_name = "p_".static::$object;
        $class_name = "Model".ucfirst(static::$object);
        $primary_key = static::$primary;
        $requete = "SELECT * FROM $table_name WHERE $primary_key=:id";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":id" => $value,
        );
        try{
            $requete_prepare->execute($values); 
            $requete_prepare->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $tab = $requete_prepare->fetchAll();
        }
        catch(PDOException $e){
            $e->getMessage();
        }
        if (empty($tab)) {
            return false;
        }
        return $tab[0];
    }
    
    public static function delete($value){
        $table_name = "p_".static::$object;
        $class_name = "Model".ucfirst(static::$object);
        $primary_key = static::$primary;
        $requete = "DELETE FROM $table_name WHERE $primary_key=:value";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":value" => $value,
        );
        try {
            $requete_prepare->execute($values);
            return true;
        }
        catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
      
    public function create($data) { 
        $table_name = "p_".static::$object;
        $attribut = "";
        $attributTag = "";
        foreach ($data as $key => $values) {
            $attribut=$attribut.$key.",";
            $attributTag = $attributTag.":".$key.",";
        }
        $attribut = rtrim($attribut,",");
        $attributTag = rtrim($attributTag,",");
        $sql = "INSERT INTO $table_name($attribut) VALUES ($attributTag)";
        $req_prep = Model::$pdo->prepare($sql);
        $values = array();
        foreach ($data as $key => $value) {
            $values[":".$key]=$value;
        }
        try {
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e) {
            $e->getMessage();
            return false;
        }
    }
    
    public static function update($data){
        $primary_key = static::$primary;
        
        $attribut ="";
        foreach ($data as $key => $value) {
            $attribut=$attribut.$key."=".":".$key.",";
        }
        $attribut = rtrim($attribut,",");
        $sql = "UPDATE p_".static::$object." SET ".$attribut." WHERE $primary_key=:primary_key";
        // Préparation de la requête
        $req_prep = Model::$pdo->prepare($sql);
        foreach ($data as $key => $value) {
            $values[":".$key]=$value;
        }
        $values[":primary_key"]=$data[$primary_key];
        // On donne les valeurs et on exécute la requête
        try {
            $req_prep->execute($values);
            return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }
}

model::Init();


