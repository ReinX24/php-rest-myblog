<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With"
);

include_once "../../config/Database.php";
include_once "../../models/Category.php";

$database = new Database();
$db = $database->connect();

$deleted_category = new Category($db);

$data = json_decode(file_get_contents("delete_category.json"));

$deleted_category->id = $data->id;

if ($deleted_category->delete()) {
    echo json_encode(
        ["message" => "Category Deleted"]
    );
} else {
    echo json_encode(
        ["message" => "Category Not Deleted"]
    );
}
