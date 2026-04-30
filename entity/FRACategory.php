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
	
	public function viewFRACategory(): array {
		$sql = "
			SELECT fc.id, fc.name, fc.description, COUNT(fa.id) AS fra_count
			FROM fra_categories fc
			LEFT JOIN fundraising_activity fa ON fc.name = fa.category
			GROUP BY fc.id, fc.name, fc.description
			ORDER BY fc.name ASC
		";

		$result = $this->db->query($sql);

		if (!$result) return [];

		return $result->fetch_all(MYSQLI_ASSOC);
	}
	
	public function editFRACategory(string $newName, string $description, string $oldName): bool {
		$fields = [];
		$params = [];
		$types = "";

		if ($newName !== '') {
			$fields[] = "name = ?";
			$params[] = $newName;
			$types .= "s";
		}

		if ($description !== '') {
			$fields[] = "description = ?";
			$params[] = $description;
			$types .= "s";
		}

		// ❗ no field to update
		if (empty($fields)) {
			return false;
		}

		$sql = "UPDATE fra_categories SET " . implode(", ", $fields) . " WHERE name = ?";
		
		$params[] = $oldName;
		$types .= "s";

		$stmt = $this->db->prepare($sql);

		if (!$stmt) return false;

		$stmt->bind_param($types, ...$params);

		return $stmt->execute();

	}
}