<?php
require_once 'model/HomeModel.php';

class HomeController extends Controller{
  private $homeRepository;

  public function __construct(){
    parent::__construct();
    $this->homeRepository = new HomeModel();
  }

  public function action_home(){
    $data = $this->homeRepository->get5Products();
    return $this->generHtml("Home", $data);
  }

  public function action_default(){
      return $this->action_home();
  }
} 