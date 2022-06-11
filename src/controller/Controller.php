<?php

abstract class Controller{
    /**
     * Action par défaut du contrôleur (à définir dans les classes filles)
     */
    public $action;
    public $navBar;
    abstract public function action_default();

    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct(){
        //On détermine s'il existe dans l'url un paramètre action correspondant à une action du contrôleur
        if (isset($_GET['act']) and method_exists($this, "action_" . $_GET["act"])) {
            //Si c'est le cas, on appelle cette action
            $this->action = "action_" . $_GET["act"]; // action_allProduct
        } else {
            $this->action = "action_default";
        }
        $this->navBar = true;
    }

    /**
     * Affiche la vue
     * @param  string $vue nom de la vue
     * @param array $data tableau contenant les données à passer à la vue
     * @return aucun
     */
    public function generHtml($vue, $data = []): string{ // vue = AllProduct
        //On extrait les données à afficher
        //On teste si la vue existe
        $file_name = "view/build" . $vue . 'View.php'; // view/buildAllProductView.php
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
        return $this->generHtml("Message", $data);
    }

    /*public function woocommerce_ajax_add_to_cart_js() {
        if (function_exists('is_product') && is_product()) {
            wp_enqueue_script('woocommerce-ajax-add-to-cart', plugin_dir_url(__FILE__) . 'assets/ajax-add-to-cart.js', array('jquery'), '', true);
        }
    }
    add_action('wp_enqueue_scripts', 'woocommerce_ajax_add_to_cart_js', 99);*/
}
