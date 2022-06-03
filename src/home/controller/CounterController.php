<?php
require_once __DIR__ . '/../view/buildCounterView.php';

class CounterController
{
  private $authenticationService;
  private $compteurRepository;

  public function __construct(AuthenticationService $authenticationService, CompteurRepository $compteurRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->compteurRepository = $compteurRepository;
  }

  public function viewAction(): string {
    if (!$this->authenticationService->isUserConnected()) {
      $this->redirectToLogin();
    }

    $this->compteurRepository->incrementCount();
    return buildCounterView($this->compteurRepository->getCount());
  }

  private function redirectToLogin(): void {
    header('Location: /e-commerce-project/src/user/login.php');
  }
}
