<?php
require_once (File::build_path(array("model", "Model.php")));

class ModelCommande extends Model{
  
    private $id_cmd;
    private $date_cmd;
    private $client_login;
    
    protected static $object="commande";
    protected static $primary="id_cmd";
    
    function getId() {
        return $this->id_cmd;
    }

    function getDate() {
        return $this->date_cmd;
    }

    function getClient() {
        return $this->client_login;
    }

    function __construct($id_cmd = NULL, $date_cmd = NULL, $client_login = NULL) {
        if (!is_null($id_cmd) && !is_null($date_cmd) && !is_null($client_login)) {
            $this->id_cmd = $id_cmd;
            $this->date_cmd = $date_cmd;
            $this->client_login = $client_login;
        }
    }
    
    public static function selectByUser($user){

        $requete = "SELECT * FROM p_commande C JOIN p_commandeProduit PC ON C.id_cmd=PC.idCommande WHERE client_login=:login;";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":login" => $user
        );
        try{
            $requete_prepare->execute($values);
            $requete_prepare->setFetchMode(PDO::FETCH_ASSOC);
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
    
    public static function selectById($id){

        $requete = "SELECT * FROM p_commande C JOIN p_commandeProduit PC ON C.id_cmd=PC.idCommande WHERE id_cmd=:id;";
        $requete_prepare = Model::$pdo->prepare($requete);
        $values = array(
            ":id" => $id
        );
        try{
            $requete_prepare->execute($values);
            $requete_prepare->setFetchMode(PDO::FETCH_ASSOC);
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
    
    static function saveProduit($data) {
        for($i = 0; $i < count($data); $i++){
           $sql = "INSERT INTO p_commandeProduit(idCommande, idProduit, Quantite) VALUES(:idCommande, :idProduit, :Quantite)";
           $req_prep = Model::$pdo->prepare($sql);
           $values = array(
               'idCommande' => $data[$i]['idCommande'],
               'idProduit' => $data[$i]['idProduit'],
               'Quantite' => $data[$i]['quantite']
           );
           try {
               $req_prep->execute($values);
            }
            catch (PDOException $e) {
                $e->getMessage();
                return false;
            }
        }
        return true;
    }
    
    static function enregistrerCommande($dataCommande,$dataProduit) {
        if(!self::create($dataCommande)) return false;
        for($i = 0; $i < count($dataProduit); $i++) $dataProduit[$i]['idCommande'] = self::$pdo->lastInsertId();
        if(!self::saveProduit($dataProduit)) return false;
        return true;
    }
}
