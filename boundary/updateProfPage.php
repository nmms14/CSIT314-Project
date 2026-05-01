<?php
require_once __DIR__ . '/../control/updateProfController.php';

class updateProfPage {
    public function display(): void {
        $message     = '';
        $messageType = '';
        $controller  = new updateProfController();

        $profileId   = (int)($_POST['profile_id']   ?? $_GET['profile_id']   ?? 0);
        $profileName = $_POST['profile_name'] ?? $_GET['profile_name'] ?? '';
        $description = $_POST['description']  ?? $_GET['description']  ?? '';

        if (!$profileId) die("No profile specified.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result      = $controller->updateProf($profileId, $profileName, $description);
            $message     = $result['message'];
            $messageType = $result['type'];

            if ($messageType === 'success') {
                header("Location: view_prof.php?success=1");
                exit;
            }
        }

        $pageTitle   = 'Dashboard';
        $activePage  = 'view_prof';
        $contentView = __DIR__ . '/views/update_prof.view.php';
        include __DIR__ . '/views/layout_ua.view.php';
    }
}
?>