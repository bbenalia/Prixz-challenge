<?php
require_once 'vendor/autoload.php';

use \Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->safeLoad();

define("STORE_URL", "http://localhost/prixz-challenge/");
define("WOO_KEY", $_ENV['CLIENT_KEY']);
define("WOO_KEY_SECRET", $_ENV['CLIENT_SECRET_KEY']);
