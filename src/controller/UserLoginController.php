<?php
require_once __DIR__ . '/../view/buildLoginForm.php';

class UserLoginController
{
  private $authenticationService;
  private $userRepository;

  public function __construct(AuthenticationService $authenticationService, UserRepository $userRepository)
  {
    $this->authenticationService = $authenticationService;
    $this->userRepository = $userRepository;
  }

  public function loginAction(): string {
    $error = '';

    if ($this->authenticationService->isUserConnected()) {
      $this->redirectToHomepage();
    }
    if ($this->isLoginFormFilledAndValid()) {
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      if ($this->userRepository->checkUserExistence($username, $password)) {
        $this->authenticationService->connectUser();
        $this->redirectToHomepage();
      } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
      }
    } elseif ($this->isOneOfTheFieldsMissing()) {
      $error = 'Veuillez remplir tous les champs';
    }

    return buildLoginForm($error);
  }

  private function isLoginFormFilledAndValid(): bool
  {
    return isset($_POST['username'], $_POST['password']) && $_POST['username'] !== '' && $_POST['password'] !== '';
  }

  private function isOneOfTheFieldsMissing(): bool
  {
    return (isset($_POST['username']) && $_POST['username'] === '')
      || (isset($_POST['password']) && $_POST['password'] === '');
  }

  private function redirectToHomepage(): void {
    header('Location: /e-commerce-project/src/');
  }
}
