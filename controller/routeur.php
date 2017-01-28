<?php

require_once(File::build_path(array("controller", "ControllerProduit.php")));
require_once(File::build_path(array("controller", "ControllerUtilisateur.php")));
require_once(File::build_path(array("controller", "ControllerCommande.php")));
require_once(File::build_path(array("controller", "ControllerPanier.php")));

class routeur {
    
    public static function myGet($nomVar) {
    if(isset($_GET[$nomVar])) return $_GET[$nomVar];
    if(isset($_POST[$nomVar])) return $_POST[$nomVar];
    return NULL;
    }
}

require_once(File::build_path(array("controller", "routeur.php")));

$controller_class = "ControllerProduit";
$action = "readAll";


if (!is_null(routeur::myGet('controller'))) {
    $controller_class = "Controller" . ucfirst(routeur::myGet('controller'));
}

if (class_exists($controller_class)) {
    $getMethods = get_class_methods($controller_class);
    if (!is_null(routeur::myGet('action'))) {
        if (!in_array(routeur::myGet('action'), $getMethods)) {
            ControllerProduit::error();
        } else {
            
            $action = routeur::myGet('action');
            $controller_class::$action();
        }
    }else {
        $controller_class::$action();
    }
} else {
            $view = "error";
            $pagetitle = "Erreur";
            require File::build_path(array("view","view.php"));
}