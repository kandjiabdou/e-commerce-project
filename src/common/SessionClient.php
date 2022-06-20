<?php
class SessionClient {
  private static $instance = null;

  private function __construct(){
    if (session_status() === PHP_SESSION_NONE) session_start();
  }

  public function set($key, $value): void {
    $_SESSION[$key] = $value;
  }

  public function get($key) {
    return $_SESSION[$key];
  }

  public function exists($key) {
    return isset($_SESSION[$key]);
  }

  public function delete($key) {
    unset($_SESSION[$key]);
  }
  public static function finishSession() {
    session_destroy();
  }

  public static function getInstance() {
    if(is_null(self::$instance)) {
      self::$instance = new SessionClient();
    }
    return self::$instance;
  }

  public function addProductToCart($pid): bool {
    var_dump($_SESSION);
    if(!array_key_exists($pid, $_SESSION['panier'])){
      $_SESSION['panier'][$pid]=1;
      var_dump($_SESSION);
      return true;
    }
    var_dump($_SESSION);
    return false;
  }
}
