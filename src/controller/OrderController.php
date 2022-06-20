<?php
require_once 'model/OrderModel.php';

class OrderController extends Controller{
  private $databaseOrder;

  public function __construct(){
    parent::__construct();
    $this->databaseOrder = new OrderModel();
  }

  public function action_order(){
    $data = $this->databaseOrder->getAllOrderbyUserId($_SESSION['id']);
    return $this->generHtml("Order", $data);
  }

  public function action_default(){
      return $this->action_Order();
  }
} 