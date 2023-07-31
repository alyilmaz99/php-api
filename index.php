<?php

declare (strict_types = 1);

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if ($parts[2] != "products") {
    http_response_code(404);
    exit;
}

$id = $parts[2] ?? null;
print_r($parts);
var_dump($id);
