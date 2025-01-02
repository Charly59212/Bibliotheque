<?php
session_start();

// Database connection
require_once '../config/db.php'; 

// Verifying user login
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
    exit;
}

// Initializing the connection
$db = new Db();
$pdo = $db->getConnection();

?>