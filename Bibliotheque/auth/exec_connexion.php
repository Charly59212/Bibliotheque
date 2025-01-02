<?php
// Connection settings
require '../auth/init.php';

// Checks the sending of the request via the form with the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieving form data
    $email = $_POST['email'];
    // Stores the password of the user
    $password = $_POST['password'];

    try {
        // Checking credentials
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = ?"); // Query to find a user
        $stmt->execute([$email]); // Execute the query with the email
        $user = $stmt->fetch(); // Get data in associative array

        // If the user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Store name and email in session
            $_SESSION['name'] = $user['name']; // Store name and email
            $_SESSION['email'] = $email; // Stores user email
            header('Location: ../views/list.php'); // Redirect to list.php
            exit; // End script
        } else {
            //If the credentials are incorrect
            $_SESSION['errorMessage'] = "Mauvais Email ou Mot de Passe."; // Error message 
            header('Location: ../index.php'); // Redirect to list.php
            exit; // End script
        }

    } catch (PDOException $e) {
        $_SESSION['errorMessage'] = "Erreur lors de la connexion. Veuillez réessayer."; // Error message 
        header('Location: ../index.php'); // Redirect to index.php
        exit; // End script
    }  
}

?>