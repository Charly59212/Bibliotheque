<?php
// Include necessary files
require_once 'classes/Bibliotheque.php';
require 'config/db.php';

// If the session is active or not
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Retrieving the current page name
$currentPage = $_SERVER['PHP_SELF'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----------Site title---------->
    <title>Bibliothèque</title>

    <!--------Fonts Google---------->
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <!-------Bootstrap Links-------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--------CDN Fontawesom-------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
    <!--------CSS style page-------->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!----------Favicon book-------->
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/livre.png">
</head>

<body>
    <header>
        <!----------Navigation-------->
        <nav class="navbar">
            <!--------If disconnected------->
            <?php if (!isset($_SESSION['name'])): ?>
                <!----Logo---->
                <div class="logo-deco">
                    <a href="index.php"><i class="me-2 fas fa-book-open"></i>Bibliothèque</a>
                </div>
            <?php endif; ?>

            <!---------If connected-------->
            <?php if (isset($_SESSION['name'])): ?>
                <!---------Logo--------->
                <div class="logo">
                    <a href="index.php"><i class="me-2 fas fa-book-open"></i>Bibliothèque</a>
                </div>

                <!----Hamburger Menu---->
                <div class="hamburger" onclick="toggleMenu()">
                    <i class="fa-solid fa-bars"></i>
                </div>

                <!---Navigation links--->
                <ul class="nav-links center-links" id="navLinks">
                    <li><a href="index.php" <?php echo ($currentPage == '../index.php') ? 'class="active"' : ''; ?>>Accueil</a></li>
                    <li><a href="views/list.php" <?php echo ($currentPage == '../views/list.php') ? 'class="active"' : ''; ?>>Livres</a></li>
                    <li><a href="views/addBook.php" <?php echo ($currentPage == '../views/addBook.php') ? 'class="active"' : ''; ?>>Ajouter un livre</a></li>
                    <li><a href="views/search.php" <?php echo ($currentPage == '../views/search.php') ? 'class="active"' : ''; ?>>Recherche</a></li>

                    <!-------Dropdown user-------->
                    <li class="dropdown dropdown-click right-dropdown">
                        <!-------User name-------->
                        <a href="#" class="dropbtn" onclick="toggleDropdown(this, event)">
                            <?php echo htmlspecialchars($_SESSION['name']); ?>
                            <i class="fa-solid fa-user"></i>
                        </a>
                        <!-----Dropdown links----->
                        <div class="dropdown-content">
                            <a href="user/profile.php">Profil</a>
                            <a href="auth/logout.php">Déconnexion</a>
                        </div>
                    </li>
                <?php endif; ?>
                </ul>
        </nav>
    </header>

    <!-----Scroll to Top Button----->
    <a href="#" id="scroll-to-top" style="display: none;">⬆</a>

    <!----Link to javascript page--->
    <script src="assets/js/script.js"></script>