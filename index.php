<?php

declare (strict_types = 1);

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

header("Content-type: application/json; charset=UTF-8");
set_exception_handler("ErrorHandler::handleException");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[2] != "products") {
    http_response_code(404);
    exit;
}

$id = $parts[3] ?? null;
$database = new Database("localhost", "product_db", "root", "2901");
$gateway = new ProductGateway($database);
$controller = new ProductController($gateway);

$controller->processRequest($_SERVER["REQUEST_METHOD"], $id);
