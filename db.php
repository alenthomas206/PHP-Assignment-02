<?php
$host = '172.31.22.43';
$user = 'Alen200627098';
$password = 'nRqhLDdm4Y';
$db = 'Alen200627098';

$dbLink = new mysqli($host, $user, $password, $db);

if ($dbLink->connect_error) {
    die("Connection failed: " . $dbLink->connect_error);
}
?>