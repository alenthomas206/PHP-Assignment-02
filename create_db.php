<?php
$host = '172.31.22.43';
$user = 'Alen200627098';
$password = 'nRqhLDdm4Y';
$db = 'Alen200627098';

$dbLink = new mysqli($host, $user, $password, $db);
if ($dbLink->connect_error) {
    die("Connection failed: " . $dbLink->connect_error);
}

$sql1 = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)";

$sql2 = "CREATE TABLE IF NOT EXISTS items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    image VARCHAR(255) DEFAULT NULL
)";

if ($dbLink->query($sql1) === TRUE && $dbLink->query($sql2) === TRUE) {
    echo "<h3>Tables created successfully ✅</h3>";
} else {
    echo "Error: " . $dbLink->error;
}

$dbLink->close();
?>
