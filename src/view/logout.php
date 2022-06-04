<?php
require_once '../common/AuthenticationService.php';
require_once '../controller/UserLogoutController.php';

$authenticationService = new AuthenticationService();

$userLogoutController = new UserLogoutController($authenticationService);
$userLogoutController->logoutAction();