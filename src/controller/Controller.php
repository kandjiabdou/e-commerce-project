<?php


abstract class Controller{
    /**
     * Action par défaut du contrôleur (à définir dans les classes filles)
     */
    public $action;
    abstract public function action_default();

    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct()
    {
        //On détermine s'il existe dans l'url un paramètre action correspondant à une action du contrôleur
        if (isset($_GET['action']) and method_exists($this, "action_" . $_GET["action"])) {
            //Si c'est le cas, on appelle cette action
            $this->action = "action_" . $_GET["action"];
        } else {
            $this->action = "action_default";
        }
    }


    /**
     * Affiche la vue
     * @param  string $vue nom de la vue
     * @param array $data tableau contenant les données à passer à la vue
     * @return aucun
     */
    public function generHtml($vue, $data = []): string{
        //On extrait les données à afficher
        extract($data);
        //On teste si la vue existe
        $file_name = "view/build" . $vue . 'View.php';
        if (file_exists($file_name)) {
            //Si oui, on l'affiche
            include $file_name;
            $buildView = "build".$vue."View";
            return $buildView($data);
        } else {
            //Sinon, on affiche la page d'->action_error
            return $this->action_error("La vue '".$vue."' n'existe pas !");
        }
    }

    /**
     * Méthode affichant une page d'erreur
     * @param  string $message Message d'erreur à afficher
     * @return aucun
     */
    public function action_error($message = ''){
        $data = ['title' => "Error",'message' => $message];
        return $this->generHtml("message", $data);
    }
}
