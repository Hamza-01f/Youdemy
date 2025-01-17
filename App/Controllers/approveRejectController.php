<?php

require_once __DIR__ . '/../Models/approveReject.php';

use App\Models\approve_reject;

$userHandler = new approve_reject();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];

    if (isset($_POST['approve'])) {
        $userHandler->approveUser($userId);
    } elseif (isset($_POST['reject'])) {
        $userHandler->rejectUser($userId);
    } elseif (isset($_POST['block'])) {
        $userHandler->blockUser($userId);
    } elseif (isset($_POST['unblock'])) {
        $userHandler->unblockUser($userId);
    } elseif (isset($_POST['delete'])) {
        $userHandler->deleteUser($userId);
    }

    header('Location: /App/views/Admin/validation.php');
    exit();
}
?>

