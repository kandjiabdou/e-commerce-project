<?php
include 'SessionClient.php';

class AuthenticationService{
  private $sessionClient;
  private $IS_CONNECTED_KEY = 'isConnected';
  private $USER_ROLE = 'role';
  private $USER_ID = 'id';

  public function __construct(){
    $this->sessionClient = SessionClient::getInstance();
  }

  public function isUserConnected(): bool{
    return $this->sessionClient->exists($this->IS_CONNECTED_KEY) && $this->sessionClient->get($this->IS_CONNECTED_KEY);
  }

  public function connectUser($role, $id): void{
    $this->sessionClient->set($this->IS_CONNECTED_KEY, true);
    $this->sessionClient->set($this->USER_ROLE, $role);
    $this->sessionClient->set($this->USER_ID, $id);
  }

  public function logoutUser(): void{
    $this->sessionClient->delete($this->IS_CONNECTED_KEY);
    $this->sessionClient->delete($this->USER_ROLE);
    $this->sessionClient->delete($this->USER_ID);
    $this->sessionClient->finishSession();
  }

  public function getSessionUserRole():int{
    return $this->sessionClient->get($this->USER_ROLE);
  }

  public function addProductToCart($pid): bool{
    return $this->sessionClient->addProductToCart($pid);
  }
}
