<?php

declare(strict_types=1);

class Category
{
    // Database stuff
    private $conn;
    private $table = "categories";

    // Properties
    public $id;
    public $name;
    public $created_at;

    // Constructor with database
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get categories
    public function read()
    {
        $query = "SELECT
            id,
            name,
            created_at
        FROM 
            {$this->table}
        ORDER BY 
            created_at DESC";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;
    }

    // TODO: Finish other functionalities
}
