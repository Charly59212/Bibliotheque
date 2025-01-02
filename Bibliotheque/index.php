<?php
session_start();
// Include header
include 'templates/header_index.php';
?>

<main>
    <!---------------Main section of the home page-------------------->
    <div class="container">
        <div class="card border shadow-sm text-center rounded-3 px-4 px-3">

            <!--------------------------Page Title------------------------>
            <h1 class="center rounded-3 bg-secondary-subtle pt-1 pb-2 mt-3">Bienvenue sur notre bibliothèque en ligne</h1>

            <!----------------------------Introduction-------------------------->
            <p class="lead fw-bold">Explorez, partagez et proposez vos lectures préférées.</p>
            <p class="intro fw-bold mt-2 px-2">Bienvenue dans notre bibliothèque en ligne, un espace dédié aux passionnés et amateurs de lecture de tous âges.
                Ici, vous trouverez une vaste collection de livres qui couvrent une multitude de genres, de la fiction et la non-fiction jusqu'aux classiques et aux œuvres contemporaines.
                Notre objectif est de créer un environnement accueillant et accessible où vous pouvez explorer de nouveaux mondes, découvrir de nouveaux auteurs et enrichir votre esprit.
                Rejoignez notre communauté de lecteurs et plongez dans l'univers des livres qui vous attend...</p>


            <!-----------Displaying success or error messages---------->
            <div class="d-flex justify-content-center">
                <?php
                // Retrieving session messages
                $success = $_SESSION['successMessage'] ?? null; // Success message
                $error = $_SESSION['errorMessage'] ?? null; // Error message

                // If a success message is present, display it in a green alert
                if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($success); ?>

                        <!---Button to close the alert--->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['successMessage']); // Delete the message after display
                    ?>
                <?php endif; ?>

                <!---If a success message is present, display it in a red alert--->
                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($error); ?>
                        <!---Button to close the alert--->
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php unset($_SESSION['errorMessage']); // Delete the message after display 
                    ?>
                <?php endif; ?>
            </div>

            <!---------------If the user is not logged in--------------->
            <?php if (!isset($_SESSION['name'])) : ?>

                <!--------------Left column: Connection----------------->
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow pt-1 mx-4 text-center bg-secondary-subtle">
                            <!---------------Titled-------------->
                            <h3 >Déjà inscrit ?</h3>
                            <h4 class="card-text">Accédez à votre espace personnel.</h4>
                            <form action="auth/exec_connexion.php" method="POST" class="border pb-2 px-4 rounded shadow-sm bg-secondary-subtle">

                                <!-------------Email---------------->
                                <div class="email">
                                    <label for="login-email" class="form-label">Email :</label>
                                    <input type="email" id="login-email" name="email" class="form-control" autocomplete="username" required>
                                </div>

                                <!-----------Password-------------->
                                <div class="password">
                                    <label for="login-password" class="form-label">Mot de passe :</label>
                                    <input type="password" id="login-password" name="password" class="form-control" autocomplete="current-password" required>
                                </div>

                                <!----------Login button----------->
                                <button type="submit" class="btn btn-primary btn-block border-1 border-dark">
                                    <i class="fas fa-user-plus me-2"></i>Se connecter
                                </button>
                            </form>
                        </div>
                    </div>

                    <!---------Right column: Registration--------------->
                    <div class="col-md-6">
                        <div class="card shadow pt-1 mx-4 text-center bg-secondary-subtle">
                            <!---------------Intitulé-------------->
                            <h3 >Nouveau sur notre site ?</h3>
                            <h4 class="card-text">Créez un compte.</h4>
                            <form class="border pb-2 px-4 rounded shadow-sm bg-secondary-subtle" action="auth/exec_inscription.php" method="POST">

                                <!--------------Name---------------->
                                <div class="name">
                                    <label for="register-name" class="form-label">Nom d'utilisateur :</label>
                                    <input type="text" id="register-name" name="name" class="form-control" autocomplete="name" required>
                                </div>

                                <!-------------Email---------------->
                                <div class="regster mb-1">
                                    <label for="register-email" class="form-label mt-1">Email :</label>
                                    <input type="email" id="register-email" name="email" class="form-control" autocomplete="email" required>
                                </div>

                                <!-----------Paswword-------------->
                                <div class="pass mb-2">
                                    <label for="register-password" class="form-label">Mot de passe :</label>
                                    <input type="password" id="register-password" name="password" class="form-control" autocomplete="new-password" required>
                                </div>

                                <!----------Login button---------->
                                <button type="submit" class="btn btn-success btn-block border-1 border-dark mt-1">
                                    <i class="fas fa-user-plus me-2"></i>Créer un compte
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>

        <!--------------------User welcome message-------------------->
    <?php else : ?>
        <!------------------If the user is logged in------------------>
        <div class="text-center">
            <h2 id="pseudo" class="text-center rounded-3 bg-secondary-subtle px-4 w-75 py-2 mx-auto my-4">Bonjour <?= htmlspecialchars($_SESSION['name']); ?> !</h2>
            <p class="lead fw-bold">Accédez dès maintenant à vos livres préférés ou découvrez les nouveautés !</p>

            <!-----------------Navigation buttons-------------------->
            <div class="text-center my-4">
                <div class="row justify-content-center g-3">

                    <!-----------List of books-------------->
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="views/list.php" class="btn btn-secondary border-2 border-white w-75">
                            <i class="fas fa-book"></i> Tous les livres
                        </a>
                    </div>

                    <!------------Find a book--------------->
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="views/search.php" class="btn btn-primary border-2 border-white w-75">
                            <i class="fas fa-search"></i> Recherche
                        </a>
                    </div>

                    <!------------Add a book--------------->
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="views/addBook.php" class="btn btn-success border-2 border-white w-75">
                            <i class="fas fa-plus-circle"></i> Ajouter un livre
                        </a>
                    </div>

                    <!------------Disconnect--------------->
                    <div class="col-12 col-md-6 col-lg-3">
                        <a href="auth/logout.php" class="btn btn-danger border-2 border-white w-75">
                            <i class="fas fa-sign-out-alt"></i> Déconnexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-----------Table of the last 5 books added------------------->
<?php
// Checks if user is logged in
if (isset($_SESSION['name'])) {

    // Initializing the Library Manager
    $libraryManager = new LibraryManager();

    // Collect the last 5 books
    $latestBooks = $libraryManager->getLatestBooks(5);

    if (!empty($latestBooks)): ?>
        <div class="card border shadow-sm px-2">
            <h1 id="book-list" class="card border shadow-sm text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mx-auto my-4 w-75">Derniers livres ajoutés</h1>
                <table class="table table-striped bg-dark-subtle">
                    <thead class="table-dark">
                        <tr>
                            <th class="col-title">Titre</th>
                            <th class="col-author">Auteur</th>
                            <th class="col-year" class="col-year">Date</th>
                            <th class="col-details text-center">Détails</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-------Loop for displaying book information-------->
                        <?php foreach ($latestBooks as $book): ?>
                            <tr class="align-middle">
                                <td class="col-title fw-bold"><?= htmlspecialchars($book['titre']); ?></td>
                                <td class="col-author fw-bold"><?= htmlspecialchars($book['auteur']); ?></td>
                                <td class="col-year fw-bold"><?= htmlspecialchars($book['annee_publication']); ?></td>
                                <td class="col-details col-actions-size align-middle text-center"><a href="views/details.php?id=<?= htmlspecialchars($book['id']); ?>" class="btn btn-success border-1 border-white btn-sm btn-details">Détails</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
<?php endif;
} ?>

<!------------------------Best Sellers----------------------------->
<div class="container mt-1 card border shadow-sm">

    <!----------------------Titled--------------------------->
    <h1 class="mb-4 fw-bold text-center rounded-3 bg-secondary-subtle py-2 w-50 mt-3 mx-auto">Best Sellers</h1>
    <div class="row">

        <!-----------------First book------------------>
        <div class="col-lg-4 col-md-4 ms-12 mb-4 mb-lg-0">
            <div class="best-seller card border shadow-sm text-center">
                <div class="card-body">
                    <h2 class="best-book">Prime time</h2>
                    <h4>Par Max Chattam</h4>
                    <img class="book-img" src="assets/img/Thriller.jpg" alt="valse" title="valse">
                    <p class="mt-3 auteur fw-bold">Édition : Albin Michel</p>
                    <p class="mt-3 story">Le JT vient de commencer sur MD1, chaîne principale de Mediaplex, le plus gros groupe multimédia d’Europe.
                        Son présentateur vedette, Paul Daki-Ferrand, se prépare à prendre la parole, de multiples petites mains s’affèrent en arrière-fond
                        pour assurer le bon déroulement de l’émission, mais oudain, tout bascule : un individu pénètre sur le plateau et menace le présentateur...</p>
                </div>
            </div>
        </div>

        <!-----------------Second book----------------->
        <div class="col-lg-4 col-md-4 ms-12 mb-4 mb-lg-0">
            <div class="best-seller card border shadow-sm text-center">
                <div class="card-body">
                    <h2 class="best-book">1984</h2>
                    <h4>Par G. Orwell</h4>
                    <img class="book-img" src="assets/img/1984.jpg" alt="1984" title="1984">
                    <p class="mt-3 auteur fw-bold">Édition : S. & Warburg </p>
                    <p class="mt-3 story">L'année en cours est incertaine, mais on pense qu'il s'agit de 1984. Une grande partie du monde est en guerre perpétuelle
                        La Grande-Bretagne est devenue une province du super-État Océania, dirigé par Big Brother qui s'engage dans une surveillance omniprésente
                        dans un négationnisme historique et une propagande constante pour persécuter l'individualité et la pensée unique...
                    </p>
                </div>
            </div>
        </div>

        <!-----------------Third book----------------->
        <div class="col-lg-4 col-md-4 ms-12 mb-4 mb-lg-0">
            <div class="best-seller card border shadow-sm text-center">
                <div class="card-body">
                    <h2 class="best-book">Ressources</h2>
                    <h4>Par V. Perriot</h4>
                    <img class="book-img" src="assets/img/Ressources.jpg" alt="source" title="source">
                    <p class="mt-3 auteur fw-bold">Édition : Casterman</p>
                    <p class="mt-3 story">Selon les milliardaires de la Silicon Valley, notre destin passe par les métavers, l'intelligence artificielle.,
                        les robots autonomes, la conquête spatiale, les énergies vertes et les voitures électriques nous permettraient de maintenir notre " niveau de vie ".
                        Mais les planétes se rapprochent dangereusement : changement climatique, biodiversité en danger... </p>
                </div>
            </div>
        </div>

    </div>
</div>
</main>

<!----------------Footer inclusion--------------------->
<?php include 'templates/footer.php';