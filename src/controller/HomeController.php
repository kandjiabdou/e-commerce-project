<?php
require_once 'database/DatabaseHomeRepository.php';

class HomeController extends Controller{
  private $homeRepository;

  public function __construct(){
    parent::__construct();
    $this->homeRepository = new DatabaseHomeRepository();
  }

  public function action_home(){
    $data = $this->homeRepository->get5Products();
    return $this->generHtml("home", $data);
  }

  public function action_default(){
      return $this->action_home();
  }
}