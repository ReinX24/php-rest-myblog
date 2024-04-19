<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Category.php";

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate category object
$category = new Category($db);

// Blog category query
$result = $category->read();

// Get row count
$num = $result->rowCount();

// Check if there are any categories
if ($num > 0) {
    $cat_arr = [];
    $cat_arr["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // converts key and value into a variable and value

        $cat_item = [
            "id" => $id,
            "name" => $name,
            "created_at" => $created_at
        ];

        // Push to "data" key
        array_push($cat_arr["data"], $cat_item);
    }

    echo json_encode($cat_arr);
} else {
    // No Categories
    echo json_encode(["message" => "No Categories Found"]);
}
