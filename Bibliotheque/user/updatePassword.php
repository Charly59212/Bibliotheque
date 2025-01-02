<?php
// Connection settings and verification
require 'init.php';

// Verifies that the form is submitted via the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userName = $_SESSION['name']; // Get the name of the logged in user from the session
    $currentPassword = trim($_POST['current_password']); // Current password entered by user
    $newPassword = trim($_POST['new_password']); // New password chosen by the user
    $confirmPassword = trim($_POST['confirm_password']); // Confirming the new password

    // Verifies that all fields are completed and that the new passwords match
    if (!empty($currentPassword) && !empty($newPassword) && $newPassword === $confirmPassword) {
        // Check current password
        $query = $pdo->prepare('SELECT password FROM utilisateurs WHERE name = :name');
        $query->execute(['name' => $userName]);
        $user = $query->fetch(PDO::FETCH_ASSOC); // Retrieves user data

        if ($user && password_verify($currentPassword, $user['password'])) {
            // Update password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Hash the new password
            $updateQuery = $pdo->prepare('UPDATE utilisateurs SET password = :password WHERE name = :name');
            $updateQuery->execute([
                'password' => $hashedPassword, // New hashed password
                'name' => $userName // User ID for update
            ]);

            // Redirection on success
            header('Location: profile.php?success=1');
            exit;
        } else {
            // Redirect if current password is incorrect
            header('Location: profile.php?error=incorrect_password');
            exit;
        }
    } else {
        // Redirection if fields are incomplete or passwords do not match
        header('Location: profile.php?error=password_error');
        exit;
    }
}

?>