<?php

class FundRaiser {
    private mysqli $db;
    public ?int $id = null;
    public ?string $username = null;

    public function __construct(mysqli $db) {
        $this->db = $db;
    }

    public function login(string $username, string $password): bool {
        $stmt = $this->db->prepare(
            "SELECT id, password FROM users WHERE username = ? AND profile = 'fund_raiser' LIMIT 1"
        );
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->bind_result($id, $stored);

        if ($stmt->fetch() && hash_equals($stored, $password)) {
            $this->id = $id;
            $this->username = $username;
            $stmt->close();
            return true;
        }

        $stmt->close();
        return false;
    }

    public function createFRA($fraName, $category, $description, $doneeInfo, $goalAmount, $endDate)
    {
        $sql = "INSERT INTO fundraising_activity
                (fra_name, category, description, donee_info, end_date, goal_amount, raised_amount, status)
                VALUES (?, ?, ?, ?, ?, ?, 0, 'Ongoing')";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param("sssssd", $fraName, $category, $description, $doneeInfo, $endDate, $goalAmount);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        return true;
    }

    public function getAllFRA()
    {
        $sql = "SELECT * FROM fundraising_activity ORDER BY created_at DESC";
        $result = $this->db->query($sql);

        if (!$result) {
            die("Query failed: " . $this->db->error);
        }

        return $result;
    }

    public function getFRAByPage($limit, $offset)
{
    $sql = "SELECT * FROM fundraising_activity ORDER BY created_at DESC LIMIT ? OFFSET ?";
    $stmt = $this->db->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $this->db->error);
    }

    $stmt->bind_param("ii", $limit, $offset);

    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    return $stmt->get_result();
}

public function countAllFRA()
{
    $sql = "SELECT COUNT(*) AS total FROM fundraising_activity";
    $result = $this->db->query($sql);

    if (!$result) {
        die("Count query failed: " . $this->db->error);
    }

    $row = $result->fetch_assoc();
    return (int)$row['total'];
}
}
?>