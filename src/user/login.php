<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/UserLoginController.php';
require_once './model/DatabaseUserRepository.php';

$userController = new UserLoginController(new AuthenticationService(), new DatabaseUserRepository());
CommonComponents::render($userController->loginAction(), false);

