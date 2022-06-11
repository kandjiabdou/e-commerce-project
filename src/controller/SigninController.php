<?php
require_once 'common/AuthenticationService.php';
require_once 'database/DatabaseUserRepository.php';

class SigninController extends Controller{
  private $authenticationService;
  private $userRepository;

  public function __construct(){
    parent::__construct();
    $this->authenticationService = new AuthenticationService();
    $this->userRepository = new DatabaseUserRepository();
    $this->navBar = false;
  }

  public function action_signin() {
    $error = '';
    $values = [
      'firstName' => '',
      'lastName' => '',
      'username' => ''
    ];

    if ($this->authenticationService->isUserConnected()) {
      $this->redirectToHomepage();
    }
    $firstName = '';
    $lastName = '';
    $username = '';
    $password = '';

    if($this->isSigninFormFilled()){
      $firstName = htmlspecialchars($_POST['firstName']);
      $lastName = htmlspecialchars($_POST['lastName']);
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
    }
     
    if ($this->isSigninFormFilledAndValid()) {
      if (!$this->userRepository->isUserNameExist($username)) {
        $this->userRepository->createUser($firstName, $lastName, $username, $password);
        $this->authenticationService->connectUser();
        $this->redirectToHomepage();
      } else {
        $values['firstName'] = $firstName;
        $values['lastName'] = $lastName;
        $values['username'] = $username;
        $error = 'Ce nom d\'utilisateur est déjà utilisé';
      }
    } elseif ($this->isOneOfTheFieldsMissing()) {
      $values['firstName'] = $firstName;
      $values['lastName'] = $lastName;
      $values['username'] = $username;
      $error = 'Veuillez remplir tous les champs';
    }
    $data = [ "values" => $values, "error" => $error];
    return $this->generHtml('Signin', $data);
  }
  public function action_default(){
    return $this->action_signin();
  }

  private function isSigninFormFilledAndValid(): bool
  {
    return $this->isSigninFormFilled()
      && $_POST['firstName'] !== ''
      && $_POST['lastName'] !== ''
      && $_POST['username'] !== ''
      && $_POST['password'] !== '';
  }
  private function isSigninFormFilled(): bool
  {
    return isset($_POST['firstName'], $_POST['lastName'], $_POST['username'], $_POST['password']);
  }
  private function isOneOfTheFieldsMissing(): bool
  {
    return (isset($_POST['firstName']) && $_POST['firstName'] === '')
      || (isset($_POST['lastName']) && $_POST['lastName'] === '')
      || (isset($_POST['username']) && $_POST['username'] === '')
      || (isset($_POST['password']) && $_POST['password'] === '');
  }
  private function redirectToHomepage(): void {
    header('Location: /e-commerce-project/src/');
    exit();
  }
}
