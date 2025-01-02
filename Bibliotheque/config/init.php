<?php
// Header inclusion
include '../templates/header.php';

// Verifying user authentication
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
    exit;
}

// Database connection
require_once '../config/db.php';

// Classes needed to manage books and library
require_once '../classes/Bibliotheque.php';
require_once '../classes/Livres.php';

// Initializing the Library Manager
$libraryManager = new LibraryManager();

?>