<?php

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if(!isset($_SESSION['panier']))
    $_SESSION['panier'] = array();

$method = 'action_'.$_POST['action'];
$method();

function action_add_product(){
  $pid = $_POST['productID'];
  if(!isset($_SESSION['panier'][$pid])){
    $_SESSION['panier'][$pid]= 1;
  }else
    $_SESSION['panier'][$pid]++;
  echo nbProductTotal();
}

function action_delete_product(){
  $pid = $_POST['productID'];
  if(isset($_SESSION['panier'][$pid])){
    unset($_SESSION['panier'][$pid]);
  }
  echo nbProductTotal();
}

function action_crement_product_qty(){
  $pid = $_POST['productID'];
  $qty = $_POST['qty'];
  $_SESSION['panier'][$pid] = (int) $qty;
  echo nbProductTotal();
}

function nbProductTotal():int{
  $nbProductTotal = 0;
  foreach( $_SESSION['panier'] as $q)
    $nbProductTotal += $q;
  return $nbProductTotal;
}
?>