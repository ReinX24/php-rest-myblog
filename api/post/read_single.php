<?php

declare(strict_types=1);

// Headers
header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog single_post object
$single_post = new Post($db);

// Get ID parameter, parameter is after the question mark
// something.com?id=3
$single_post->id = isset($_GET["id"]) ? $_GET["id"] : die();

// Get single post
$single_post->read_single();

// Create an array
$post_arr = [
    "id" => $single_post->id,
    "title" => $single_post->title,
    "body" => $single_post->body,
    "author" => $single_post->author,
    "category_id" => $single_post->category_id,
    "category_name" => $single_post->category_name
];

// Convert into json data
// Type the following into the browser:
// http://localhost/php-rest-myblog/api/post/read_single.php?id=1
print_r(json_encode($post_arr));
