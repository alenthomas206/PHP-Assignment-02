<?php
require 'db.php';
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $queryStmt = $dbLink->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $queryStmt->bind_param("ss", $username, $hashedPassword);

        if ($queryStmt->execute()) {
            $message = "Registration successful! <a href='login.php'>Click here to login.</a>";
        } else {
            $message = "Error: " . $queryStmt->error;
        }

        $queryStmt->close();
    } else {
        $message = "All fields are required.";
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
    <h2>Register</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"> <?= $message ?> </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
