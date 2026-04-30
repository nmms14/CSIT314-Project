<?php
require_once __DIR__ . '/../config/DBConnection.php';

class FRACategory
{
    private mysqli $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }

    public function createFRACategory(string $name, string $description): array {
        // check if name already exists
        $check = $this->db->prepare("SELECT id FROM fra_categories WHERE name = ?");
        $check->bind_param('s', $name);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) {
            return ['type' => 'error', 'message' => 'Category name already exists.'];
        }
        $check->close();

        $stmt = $this->db->prepare(
            "INSERT INTO fra_categories (name, description) VALUES (?, ?)"
        );

        if (!$stmt) return ['type' => 'error', 'message' => 'Failed to prepare statement.'];

        $stmt->bind_param('ss', $name, $description);
        $success = $stmt->execute();
        $stmt->close();

        if ($success) {
            return ['type' => 'success', 'message' => 'Category created successfully!'];
        }

        return ['type' => 'error', 'message' => 'Failed to create category.'];
    }

    public function getAllCategories(): array {
        $result = $this->db->query("SELECT name FROM fra_categories ORDER BY name ASC");
        $categories = [];
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['name'];
        }
        return $categories;
    }
}