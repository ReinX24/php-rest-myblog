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

    public function read_single()
    {
        $query = "SELECT
            id,
            name,
            created_at
        FROM 
            {$this->table} c
        WHERE
            id = :id
        LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row["id"];
        $this->name = $row["name"];
        $this->created_at = $row["created_at"];
    }

    public function create()
    {
        $query = "INSERT INTO
            {$this->table}
        SET
            id = :id,
            name = :name";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));

        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":name", $this->name);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: {$stmt->error}.\n";
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE
            {$this->table}
        SET
            name = :name
        WHERE
            id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: {$stmt->error}.\n";
            return false;
        }
    }

    public function delete()
    {
        $query = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Error: {$stmt->error}.\n";
            return false;
        }
    }

    // TODO: Finish other functionalities
}
