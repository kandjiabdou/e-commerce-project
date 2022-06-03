<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/UserSigninController.php';
require_once './model/DatabaseUserRepository.php';

$userController = new UserSigninController(new AuthenticationService(), new DatabaseUserRepository());
CommonComponents::render($userController->signinAction(), false);

