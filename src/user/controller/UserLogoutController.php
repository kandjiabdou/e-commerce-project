<?php
require_once __DIR__ . '/../view/buildLoginForm.php';

class UserLogoutController
{
  private $authenticationService;

  public function __construct(AuthenticationService $authenticationService)
  {
    $this->authenticationService = $authenticationService;
  }

  public function logoutAction(): void {
    $this->authenticationService->logoutUser();
    $this->redirectToLogin();
  }

  private function redirectToLogin(): void {
    header('Location: /e-commerce-project/src/user/login.php');
  }
}
