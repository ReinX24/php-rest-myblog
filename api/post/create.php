<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header(
    "Access-Control-Allow-Headers: Access-Control-Allow-Headers, 
    Content-Type, Access-Control-Allow-Methods, Authorization, 
    X-Requested-With"
);

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;
