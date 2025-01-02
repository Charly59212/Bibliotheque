<?php
// Connection settings and verification
require 'init.php';

// Verifies that the form is submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_SESSION['name']; // Get the name of the logged in user from the session
    $newName = trim($_POST['name']); // New name entered by user
    $newEmail = trim($_POST['email']); // New email entered by user

    // Verify that all required fields are completed
    if (!empty($newName) && !empty($newEmail)) {
        // Request to update user name and email
        $query = $pdo->prepare('UPDATE utilisateurs SET name = :newName, email = :newEmail WHERE name = :userName');
        $query->execute([
            'newName' => $newName, // New user name
            'newEmail' => $newEmail, // New user email
            'userName' => $userName // User ID to update
        ]);

        // Update session with new name
        $_SESSION['name'] = $newName;

        // Redirection on success
        header('Location: profile.php?success=1');
        exit;
        } else {
        // Displays an error message if the fields are incomplete
        echo "Tous les champs sont obligatoires.";
    }
}

?>