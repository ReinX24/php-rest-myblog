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

// Single category
$single_category = new Category($db);

$single_category->id = isset($_GET["id"]) ? $_GET["id"] : die();

$single_category->read_single();

$category_arr = [
    "id" => $single_category->id,
    "name" => $single_category->name,
    "created_at" => $single_category->created_at
];

// echo "Test";

print_r(json_encode($category_arr));
