<?php
require_once "controller/Controller.php"; //Inclusion de la classe Controller
require_once 'common/CommonComponents.php';

$controllers = ["Home","Product", "Login", "Register","SingleProduit"]; //Liste des contrôleurs
$controller_default = "Home"; //Nom du contrôleur par défaut

//On teste si le paramètre controller existe et correspond à un contrôleur de la liste $controllers
if (isset($_GET['ctrl']) and in_array($_GET['ctrl'], $controllers)) {
    $nom_controller = $_GET['ctrl'];
} else {
    $nom_controller = $controller_default;
}
    
//On détermine le nom de la classe du contrôleur 
$nom_classe =  $nom_controller.'Controller';

//On détermine le nom du fichier contenant la définition du contrôleur
$nom_fichier = 'controller/' .  $nom_classe . '.php'; 

//Si le fichier existe
if (file_exists($nom_fichier)) {
    //On l'inclut et on instancie un objet de cette classe
    include_once $nom_fichier;
    $controller = new $nom_classe();
    $action = $controller->action;
    $composanthtml = $controller->$action();
    CommonComponents::render($composanthtml);
} else {
    include_once 'view/build404View.php';
    $html404 = build404View();
    CommonComponents::render($html404, false);
    exit();
}