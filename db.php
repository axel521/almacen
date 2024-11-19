<?php
$host = 'skyblue-capybara-802735.hostingersite.com';
$dbname = 'u906795539_123';
$username = 'u906795539_axel';
$password = '&Aa17853859';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
