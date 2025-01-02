<?php
// Connection settings
require '../auth/init.php';

// Verifying that form is submitted with the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieves data sent from the form
    $name = $_POST['name']; // User name
    $email = $_POST['email']; // User email
    $password = $_POST['password']; // User password

    // Checks if all fields are filled
    if (empty($name) || empty($email) || empty($password)) {
        // Store an error message in the session
        $_SESSION['errorMessage'] = "Tous les champs sont obligatoires.";
        // Redirects to home page
        header('Location: ../index.php');
        exit; // End script
    }

    try {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // SQL query to insert new user into table
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (name, email, password) VALUES (?, ?, ?)");
         // Runs query with name, email and hashed password
        $stmt->execute([$name, $email, $hashedPassword]);
        // Success message after registration
        $_SESSION['successMessage'] = "Inscription réussie ! Vous pouvez vous connecter.";
        // Redirects to home page
        header('Location: ../index.php'); 
        exit; // End script

    } catch (PDOException $e) {
        // Checks if the error is due to a constraint violation
        if ($e->getCode() == 23000) {
            // Error message in case of already existing email or name
            $_SESSION['errorMessage'] = "Email ou nom déjà utilisé. Veuillez en choisir un autre svp.";
        } else {
            // Generic error message in case of problem
            $_SESSION['errorMessage'] = "Une erreur s'est produite. Veuillez réessayer.";
        }
        header('Location: ../index.php'); // Redirects to home page
        exit; // End script
    }
}

?>