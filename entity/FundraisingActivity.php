<?php
require_once __DIR__ . '/../config/database.php';

class FundRaisingActivity
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    public function createFundraisingActivity($fraName, $description, $startDate, $endDate, $goalAmount)
    {
        $sql = "INSERT INTO fundraising_activity (fra_name, description, start_date, end_date, goal_amount)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return false;
        }

        $stmt->bind_param("sssdd", $fraName, $description, $startDate, $endDate, $goalAmount);
        return $stmt->execute();
    }
}
?>