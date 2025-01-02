<?php
session_start();

// Includes database connection file
require '../config/db.php';

// Initializes the PDO connection via the Db class
$db = new Db();
$pdo = $db->getConnection();

?>