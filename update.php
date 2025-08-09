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
$title = "";
$image = "";
$message = "";

$queryStmt = $dbLink->prepare("SELECT * FROM items WHERE id = ?");
$queryStmt->bind_param("i", $itemId);
$queryStmt->execute();
$dataset = $queryStmt->get_result();

if ($dataset->num_rows === 1) {
    $record = $dataset->fetch_assoc();
    $title = $record['title'];
    $image = $record['image'];
} else {
    $message = "Record not found.";
}
$queryStmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = trim($_POST['title']);

    if (!empty($newTitle)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $newImage = basename($_FILES['image']['name']);
            $tmpPath = $_FILES['image']['tmp_name'];
            $uploadPath = "uploads/" . $newImage;
            move_uploaded_file($tmpPath, $uploadPath);
        } else {
            $newImage = $image; 
        }

        $update = $dbLink->prepare("UPDATE items SET title = ?, image = ? WHERE id = ?");
        $update->bind_param("ssi", $newTitle, $newImage, $itemId);

        if ($update->execute()) {
            $message = "Record updated successfully.";
            $title = $newTitle;
            $image = $newImage;
        } else {
            $message = "Error: " . $dbLink->error;
        }
        $update->close();
    } else {
        $message = "Title cannot be empty.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CraftShelf — PHP App</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <h2>Update Record</h2>
    <?php if (!empty($message)): ?>
        <div class="alert alert-info"> <?= $message ?> </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($title) ?>" required>
        </div>
        <div class="mb-3">
            <label>Current Image:</label><br>
            <?php if (!empty($image)): ?>
                <img src="uploads/<?= htmlspecialchars($image) ?>" width="120">
            <?php else: ?>
                No image uploaded.
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Upload New Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-primary">Done</a>

    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
