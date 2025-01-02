<?php
// Connection settings and verification
require '../config/init.php';

$booksPerPage = 10; // Number of books per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page (default 1)
$offset = ($currentPage - 1) * $booksPerPage; // Offset calculation

// Retrieving books for the current page
$books = $libraryManager->getBooksByPage($booksPerPage, $offset);

// Retrieving the total number of books
$totalBooks = $libraryManager->countAllBooks();
$totalPages = ceil($totalBooks / $booksPerPage);
?>

<main>
    <!--------------------User Greeting---------------------->
    <div class="container">
        <h2 id="pseudo" class="text-center rounded-3 bg-dark-subtle px-4 w-50 py-2 mx-auto my-4">Bonjour <?= htmlspecialchars($_SESSION['name']); ?> !</h2>

        <!----------------------------Title page----------------------->
        <div class="card border shadow-sm">
            <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mt-3 mx-auto mb-4 w-75">Liste des livres</h1>

            <!----------------------Book list table-------------------->
            <table class="table table-striped bg-dark-subtle">
                <thead class="table-dark">
                    <tr>
                        <th class="col-number">N°</th>
                        <th class="col-title">Titre</th>
                        <th class="col-author">Auteur</th>
                        <th class="col-year">Date</th>
                        <th class="col-isbn">ISBN</th>
                        <th class=col-category>Genre</th>
                        <th class="col-actions text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($books)): ?>
                        <?php $counter = $offset + 1; // Initialization of the counter according to the offset
                        ?>
                        <!-------Loop for displaying the list of books----------->
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td class="col-number align-middle fw-bold"><?= $counter++; ?></td> <!---Numérotation basée sur le compteur--->
                                <td class="col-title align-middle fw-bold"><?= htmlspecialchars($book['titre']); ?></td>
                                <td class="col-author align-middle fw-bold"><?= htmlspecialchars($libraryManager->getAuthorNameById($book['auteur_id'])); ?></td>
                                <td class="col-year align-middle fw-bold"><?= htmlspecialchars($book['annee_publication']); ?></td>
                                <td class="col-isbn align-middle fw-bold"><?= htmlspecialchars($book['isbn']); ?></td>
                                <td class="col-category align-middle fw-bold"><?= htmlspecialchars($libraryManager->getCategoryNameById($book['categorie_id'])); ?></td>

                                <!----------Buttons to view details, edit or delete a book------------->
                                <td class="col-actions-size align-middle text-center">
                                    <a class="btn-details btn btn-success btn-sm border-1 border-white" href="details.php?id=<?= htmlspecialchars($book['id']); ?>">Détails</a>
                                    <a class="btn-update btn btn-primary btn-sm border-1 border-white" href="update.php?id=<?= htmlspecialchars($book['id']); ?>">Modifier</a>
                                    <a class="btn-delete btn btn-danger btn-sm border-1 border-white" href="delete.php?isbn=<?= htmlspecialchars($book['isbn']); ?>"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre ?\n\n⚠️ Attention : Cette action est irréversible !')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-----------If no books in the librarye----------->
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center">Aucun livre trouvé.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!--------------Main container for pagination-------------->
        <div class="pagination-container">
            <div class="pagination">

                <!-------Previous page button if the user is not on the first page------->
                <?php if ($currentPage > 1): ?>
                    <a href="list.php?page=<?= $currentPage - 1; ?>" class="btn btn-secondary">Précédent</a>
                <?php endif; ?>

                <!-------------------Loop to generate links for each page--------------->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>

                    <!--------------Link to a specific page--------------->
                    <a href="list.php?page=<?= $i; ?>" class="btn <?= $i == $currentPage ? 'btn-primary' : 'btn-light'; ?>">

                        <!---------Displaying the page number------------->
                        <?= $i; ?>
                    </a>
                <?php endfor; ?>

                <!------Next page button if user is not on last page------>
                <?php if ($currentPage < $totalPages): ?>
                    <a href="list.php?page=<?= $currentPage + 1; ?>" class="btn btn-secondary">Suivant</a>
                <?php endif; ?>
            </div>
        </div>

        <!--------------Table of the last 5 books added--------------->
        <?php if (isset($libraryManager) && !empty($latestBooks = $libraryManager->getLatestBooks(5))): // Récupère les 5 derniers livres ?>
            <div class="my-5 card border shadow-sm px-2">

                <!------------Table title------------>
                <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mt-3 mx-auto mb-4 w-75">Derniers livres ajoutés</h1>

                <!-------Book information table------>
                <table class="table table-striped bg-dark-subtle">
                        <thead class="table-dark">
                            <tr>
                                <th class="col-title">Titre</th>
                                <th class="col-author">Auteur</th>
                                <th class="col-year">Date</th>
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
                                    <td class="col-details col-actions-size align-middle text-center"><a href="details.php?id=<?= htmlspecialchars($book['id']); ?>" class="btn btn-success border-1 border-white btn-sm btn-details">Détails</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
        <?php endif; ?>

        <!-------------Navigation buttons---------------->
        <div class="text-center my-4">
            <div class="row justify-content-center g-3">

                <!----------Back to home------------->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="../index.php" class="btn btn-secondary border-2 border-white w-75">
                        <i class="fas fa-home me-2"></i> Accueil
                    </a>
                </div>

                <!----------Find a book-------------->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="search.php" class="btn btn-primary border-2 border-white w-75">
                        <i class="fas fa-search me-2"></i> Recherche
                    </a>
                </div>

                <!-----------Add a book------------->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="addBook.php" class="btn btn-success border-2 border-white w-75">
                        <i class="fas fa-plus-circle me-2"></i> Ajouter un livre
                    </a>
                </div>

                <!-----------Disconnect------------>
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="../auth/logout.php" class="btn btn-danger border-2 border-white w-75">
                        <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!----------------Footer inclusion--------------------->
<?php include '../templates/footer.php';