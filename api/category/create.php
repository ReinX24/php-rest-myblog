<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With"
);

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->connect();

$new_category = new Category($db);

$data = json_decode(file_get_contents("new_category.json"));

$new_category->id = $data->id;
$new_category->name = $data->name;

if ($new_category->create()) {
    echo json_encode(
        ["message" => "Category Created"]
    );
} else {
    echo json_encode(
        ["message" => "Category Not Created"]
    );
}
