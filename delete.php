<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$itemId = $_GET['id'];

$queryStmt = $dbLink->prepare("SELECT image FROM items WHERE id = ?");
$queryStmt->bind_param("i", $itemId);
$queryStmt->execute();
$dataset = $queryStmt->get_result();

if ($dataset->num_rows === 1) {
    $record = $dataset->fetch_assoc();
    $imagePath = 'uploads/' . $record['image'];
    if (!empty($record['image']) && file_exists($imagePath)) {
        unlink($imagePath);
    }
}
$queryStmt->close();

// Delete the record
$delete = $dbLink->prepare("DELETE FROM items WHERE id = ?");
$delete->bind_param("i", $itemId);
$delete->execute();
$delete->close();

header("Location: index.php");
exit();
?>
