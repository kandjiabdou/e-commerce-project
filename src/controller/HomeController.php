<?php
require_once __DIR__ . '/../view/buildHomeView.php';

class HomeController{
  private $homeRepository;

  public function __construct(HomeRepository $homeRepository){
    $this->homeRepository = $homeRepository;
  }

  public function viewAction(): string {
    return buildHomeView($this->homeRepository->get5Products());
  }
}