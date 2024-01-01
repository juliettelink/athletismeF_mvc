<?php

// Sécurise le cookie de session avec httponly
session_set_cookie_params([
    'lifetime' => 3600,
    'path' => '/',
    'domain' => $_SERVER['SERVER_NAME'],
    'httponly' => true
]);
session_start();

define('_ROOTPATH_', __DIR__);
define('_TEMPLATEPATH_', __DIR__.'/templates');

define("ROLE_USER", "user");
define("ROLE_ADMIN", "admin");

spl_autoload_register();

use App\Controller\Controller;

$controller = new Controller();
$controller->route();

?>