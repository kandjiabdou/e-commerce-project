<?php
require_once 'model/HomeModel.php';

class HomeController extends Controller{
  private $databaseHome;

  public function __construct(){
    parent::__construct();
    $this->databaseHome = new HomeModel();
  }

  public function action_home(){
    $data = $this->databaseHome->get5Products();
    return $this->generHtml("Home", $data);
  }

  public function action_default(){
      return $this->action_home();
  }
} 