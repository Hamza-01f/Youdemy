<?php

namespace App\Controllers;

require_once __DIR__.'/../../vendor/autoload.php';

require_once __DIR__.'/../Config/Database.php';




use  App\Config\Database;
use App\Models\Tag;


class TagController {

    public function addTag(string $name) {
        $name = trim($name);
        
        if (empty($name)) {
            return "Tag name cannot be empty.";
        }

        $tag = new Tag($name);
        $conn = Database::getInstance()->getConnection();
    
        $stmt = $conn->prepare("INSERT INTO tags (name) VALUES (:name)");
        $stmt->bindParam(':name', $tag->getName(), \PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Tag added successfully!";
        } else {
            return "Failed to add tag.";
        }
    }

    public function getTags() {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->query("SELECT * FROM tags");
        return $stmt->fetchAll();
    }


    public function deleteTag($id) {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("DELETE FROM tags WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return "Tag deleted successfully!";
        } else {
            return "Failed to delete tag.";
        }
    }

    public function updateTag($id, $name) {
        $conn = Database::getInstance()->getConnection();
        $stmt = $conn->prepare("UPDATE tags SET name = :name WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, \PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "Tag updated successfully!";
        } else {
            return "Failed to update tag.";
        }
    }
}

