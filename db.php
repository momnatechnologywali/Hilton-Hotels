<?php
$host = 'YOUR_NEON_HOST_HERE'; // Replace with your Neon host, e.g., ep-your-project-123456.us-east-2.aws.neon.tech
$port = '5432';
$dbname = 'dbvvf100grym8d';
$user = 'uws1gwyttyg2r';
$password = 'k1tdlhq4qpsf';
 
try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
