<?php
require_once "controller/Controller.php"; //Inclusion de la classe Controller
require_once 'common/CommonComponents.php';

$controllers = ["Home","Product", "Panier", "Login", "Signin","SingleProduit", "Admin", "Checkout", "Order"]; //Liste des contrôleurs
$controller_default = "Home"; //Nom du contrôleur par défaut

//On teste si le paramètre controller existe et correspond à un contrôleur de la liste $controllers
if (isset($_GET['ctrl']) and in_array($_GET['ctrl'], $controllers)) {
    $nom_controller = $_GET['ctrl'];
} else {
    $nom_controller = $controller_default;
}

if (session_status() === PHP_SESSION_NONE) session_start();

if(isset($_SESSION['isConnected']) && $_SESSION['isConnected']){ // connecté
    $role = $_SESSION['role'];
    // si l'utilisateur est connecté
    // mais veut acceder à la page admin
    if($role == 2 and $nom_controller == "Admin" ) $nom_controller = "Home";
    // si l'admin veut acceder à d'autres pages
    if($role == 1 and $nom_controller !== "Login") $nom_controller = "Admin";
}else {// si l'utilisateur n'est pas connecté
    // mais veut acceder à la page admin
    if($nom_controller == "Admin" ) $nom_controller = "Home";
}

/*
- connected : admin => ctrl = Admin
- connected : user and ctrl=Admin => ctrl = home
- not connected : ctrl=Admin | check => home
*/
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
    CommonComponents::render($composanthtml, $controller->navBar, $nom_controller);
} else {
    include_once 'view/build404View.php';
    $html404 = build404View();
    CommonComponents::render($html404, false);
    exit();
}