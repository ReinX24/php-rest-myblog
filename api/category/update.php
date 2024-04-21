<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: PUT");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With"
);

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->connect();

$updated_category = new Category($db);

$data = json_decode(file_get_contents("update_category.json"));

$updated_category->id = $data->id;
$updated_category->name = $data->name;

if ($updated_category->update()) {
    echo json_encode(
        ["message" => "Category Updated"]
    );
} else {
    echo json_encode(
        ["message" => "Category Not Updated"]
    );
}
