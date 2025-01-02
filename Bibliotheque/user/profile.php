<?php
// Connection settings and verification
require 'init.php';

// Retrieves logged in user information
$userName = $_SESSION['name']; // Get the name of the logged in user from the session
$query = $pdo->prepare('SELECT name, email FROM utilisateurs WHERE name = :name'); // Check current user information
$query->execute(['name' => $userName]); // Execute the query
$user = $query->fetch(PDO::FETCH_ASSOC); // Get information in an associative array

if (!$user) {
    die("Utilisateur introuvable.");
}

// Header inclusion
include '../templates/header.php';
?>

<!--------------------Change Notification------------------->
<div id="notification" class="notification"></div>

<!--------------------------Title page------------------------>
<div class="container" style="min-height: 90vh;">
    <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mx-auto mb-4 w-75">Bienvenue sur votre profil <?php echo htmlspecialchars($_SESSION['name']); ?></h1><br>

    <!-------------------Profile Summary------------------------>
    <p class="profil profil-text lead fw-bold text-center">Votre nom d'utilsateur : <?php echo htmlspecialchars($user['name']); ?></p>
    <p class="profil profil-text lead fw-bold text-center mb-5">Votre adresse email : <?php echo htmlspecialchars($user['email']); ?></p>

    <!-----------Change user name or email------------>
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4 mb-lg-0">
            <form action="updateProfile.php" method="POST">
                <div class="card border shadow-sm px-3 py-2">
                    <h2 class="profil-text">Modifier les informations</h2>

                    <!-----------------Name---------------->
                    <div class="my-3">
                        <label for="name">Nom :</label>
                        <input type="text" id="name" class="form-control" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" autocomplete="name" required>
                    </div>

                    <!----------------Email--------------->
                    <div class="mb-3">
                        <label for="email">Email :</label>
                        <input type="email" id="email" class="form-control" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" autocomplete="email" required>
                    </div>

                    <!---------Validation button--------->
                    <div class="my-4 text-center">
                        <button type="submit" class="btn btn-secondary border-2 border-white"><i class="fas fa-floppy-disk"></i> Enregistrer les modifications</button>
                    </div>
            </form>
        </div>
    </div>

    <!-----------Change user password------------>
    <div class="col-lg-6 col-md-12">
        <form action="updatePassword.php" method="POST">
            <div class="card border shadow-sm px-3 py-2">
                <h2 class="profil-text">Changer le mot de passe</h2>

                <!-----------Verifying user password----------->
                <div class="my-3">
                    <label for="current_password">Mot de passe actuel :</label>
                    <input type="password" id="current_password" class="form-control" name="current_password" required>
                </div>

                <!--------------New user password-------------->
                <div class="mb-3">
                    <label for="new_password">Nouveau mot de passe :</label>
                    <input type="password" id="new_password" class="form-control" name="new_password" required>
                </div>

                <!-------Checking the new user password------->
                <div class="mb-3">
                    <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" required>
                </div>

                <!--------------Validation button------------->
                <div class="my-4 text-center">
                    <button type="submit" class="btn btn-secondary border-2 border-white mb-5"><i class="fas fa-pen-nib"></i> Changer le mot de passe</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!------------Navigation buttons--------------->
<div class="text-center">
    <div class="row justify-content-center g-3">
        <!----------Back to list------------->
        <div class="col-12 col-md-4 col-lg-4">
            <a class="btn btn-primary border-2 border-white my-5 px-5" href="../views/list.php">
                <i class="fas fa-right-from-bracket"></i> Quitter</a>
        </div>
    </div>
</div>
</div>

<!------------Footer inclusion----------------->
<?php include '../templates/footer.php'; ?>