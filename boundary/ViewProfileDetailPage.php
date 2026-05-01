<?php
require_once __DIR__ . '/../control/SuspendProfileController.php';

class ViewProfileDetailPage {

    public function displayProfileDetails(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST'
            || ($_POST['action'] ?? '') !== 'suspend') {
            header('Location: view_prof.php');
            exit;
        }

        $profileID  = (int)($_POST['profile_id'] ?? 0);
        $controller = new SuspendProfileController();
        $success    = $controller->suspendUserProfile($profileID);

        $type = $success ? 'success' : 'error';
        $msg  = $success
            ? 'Profile suspended successfully.'
            : 'Unable to suspend profile.';

        header("Location: view_prof.php?type={$type}&msg=" . urlencode($msg));
        exit;
    }
}
