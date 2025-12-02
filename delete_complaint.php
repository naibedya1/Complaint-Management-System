<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['complaint_id'])) {
    $complaintId = $_POST['complaint_id'];
    $userId = $_SESSION['user_id'];

    $query = "DELETE FROM complaints WHERE id = $complaintId AND user_id = $userId";

    if ($conn->query($query)) {
        $_SESSION['success'] = "Complaint deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete the complaint. Please try again.";
    }
}


header("Location: user_dashboard.php");
exit;
?>
