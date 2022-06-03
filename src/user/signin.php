<?php
require_once '../common/CommonComponents.php';
require_once '../common/AuthenticationService.php';
require_once './controller/UserSigninController.php';
require_once './model/DatabaseUserRepository.php';

$userController = new UserSigninController(new AuthenticationService(), new DatabaseUserRepository());
CommonComponents::render($userController->signinAction(), false);
<<<<<<< HEAD
//salut
//j

=======
//salut
>>>>>>> 5ec9765b27e6f06bd9f847e8a19e1eea6f5ee860
