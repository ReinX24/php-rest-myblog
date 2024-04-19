<?php

declare(strict_types=1);

// Headers
// header("Access-Control-Allow-Origin: *"); // api can be accessed by anyone
// header("Content-Type: application/json");

include_once "../../config/Database.php";
include_once "../../models/Post.php";

// Instantiate database and connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Blog post query
$result = $post->read();

// Get row count
$num = $result->rowCount();

// Check if there are any posts
if ($num > 0) {
    // Post array
    $posts_arr = [];
    $posts_arr["data"] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row); // converts key and value into a variable and value

        $post_item = [
            "id" => $id,
            "title" => $title,
            "body" => html_entity_decode($body),
            "author" => $author,
            "category_id" => $category_id,
            "category_name" => $category_name
        ];

        // Push to "data" key
        array_push($posts_arr["data"], $post_item);
    }

    // Turn to JSON & output
    echo "test";
    // echo json_encode($posts_arr);
} else {
    // No posts
    echo "not pog";
    // echo json_encode(["message" => "No Posts Found"]);
}
