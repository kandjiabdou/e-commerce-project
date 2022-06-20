<?php
require_once 'common/AuthenticationService.php';
require_once 'model/UserModel.php';

class LoginController extends Controller{
  private $authenticationService;
  private $databaseUser;

  public function __construct(){
    parent::__construct();
    $this->authenticationService = new AuthenticationService();
    $this->databaseUser = new UserModel();
    $this->navBar = false;
  }

  public function action_login(){
    $error = '';
    if ($this->authenticationService->isUserConnected()) {
      $this->redirectToHomepage();
    }
    if ($this->isLoginFormFilledAndValid()){
      $username = htmlspecialchars($_POST['username']);
      $password = htmlspecialchars($_POST['password']);
      if ($this->databaseUser->checkUserExistence($username, $password)) {
        //L'utilisateur existe, il peut se connecter
        $role = $this->databaseUser->getUserRole($username);
        $id = $this->databaseUser->getUserID($username);
        $this->authenticationService->connectUser($role, $id);
        if($role == 2 ) $this->redirectToHomepage();
        else $this->redirectToAminpage();
      } else {
        $error = 'Nom d\'utilisateur ou mot de passe incorrect';
      }
    } elseif ($this->isOneOfTheFieldsMissing()) {
      $error = 'Veuillez remplir tous les champs';
    }

    return $this->generHtml('Login', $error);
  }

  public function action_logout(): void {
    $this->authenticationService->logoutUser();
    $this->redirectToHomepage();
  }

  private function isLoginFormFilledAndValid(): bool{
    return isset($_POST['username'], $_POST['password']) && $_POST['username'] !== '' && $_POST['password'] !== '';
  }

  private function isOneOfTheFieldsMissing(): bool{
    return (isset($_POST['username']) && $_POST['username'] === '')
      || (isset($_POST['password']) && $_POST['password'] === '');
  }

  private function redirectToHomepage(): void {
    header('Location: /e-commerce-project/src/');
    exit();
  }

  private function redirectToAminpage(): void {
    header('Location: /e-commerce-project/src/?ctrl=Admin');
    exit();
  }

  public function action_default(){
    return $this->action_login();
  }
}
