<?php
require_once __DIR__ . '/../config/DBConnection.php';

class FRACategory
{
    private mysqli $db;

    public function __construct() {
        $this->db = DBConnection::getInstance();
    }

    public function createFRACategory(string $name, string $description): array {
        $stmt = $this->db->prepare(
            "INSERT INTO fra_categories (name, description) VALUES (?, ?)"
        );

        if (!$stmt) return ['type' => 'error', 'message' => 'Failed to prepare statement.'];

        $stmt->bind_param('ss', $name, $description);

        try {
            $success = $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            return ['type' => 'error', 'message' => 'Category name already exists.'];
        }

        $stmt->close();

        if ($success) {
            return ['type' => 'success', 'message' => 'Category created successfully!'];
        }

        return ['type' => 'error', 'message' => 'Failed to create category.'];
    }
}