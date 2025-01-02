<?php
// Connection settings and verification
require '../config/init.php';

// Initializing results
$books = []; // Empty array to store search results

// Vchecks if the GET request is used and if a title or author is specified
if ($_SERVER['REQUEST_METHOD'] === 'GET' && (!empty($_GET['title']) || !empty($_GET['authorName']))) {
    $title = $_GET['title'] ?? ''; // Title recovery
    $authorName = $_GET['authorName'] ?? ''; // Retrieving the author's name

    // Search for books by title or author name
    $books = $libraryManager->searchBooks($title, $authorName);
}
?>

<div class="container">
    <!---------------------------Title page--------------------------->
    <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mx-auto mb-4 w-75">Recherche d'un livre</h1>
    <form method="GET" action="">

        <!----------Search by title-------------->
        <div class="mb-3 fw-bold">
            <label for="title" class="form-label">Titre</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Rechercher par titre">
        </div>

        <!----------Search by author------------>
        <div class="mb-3 fw-bold">
            <label for="authorName" class="form-label">Nom de l'auteur</label>
            <input type="text" name="authorName" id="authorName" class="form-control" placeholder="Rechercher par auteur">
        </div>

        <!-----------Search button-------------->
        <div class="text-center mb-3">
            <button type="submit" class="btn btn-success border-2 border-white mt-3 mb-4 px-5"><i class="fas fa-search"></i> Rechercher</button>
        </div>
    </form>

    <!----Checks if a title or author is searched------->
    <?php if (!empty($_GET['title']) || !empty($_GET['authorName'])): ?>
        <div class="card border shadow-sm px-2">
            <!-----------Search results table------------->
            <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle py-2 mx-auto m-4 w-75">Résultats</h1>
            <table class="table table-striped bg-dark-subtle">
                <thead>
                    <tr class="table-dark">
                        <th class="col-title">Titre</th>
                        <th class="col-author">Auteur</th>
                        <th class="col-year">Année</th>
                        <th class="col-isbn">ISBN</th>
                        <th class="col-category">Catégorie</th>
                        <th class="col-details text-center">Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <!---------If no results-------->
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun résultat trouvé.</td>
                        </tr>
                    <?php else: ?>
                        <!---------Loop for displaying book information---------->
                        <?php foreach ($books as $book): ?>
                            <tr class="align-middle">
                                <td class="col-title fw-bold"><?= htmlspecialchars($book['titre']); ?></td>
                                <td class="col-author fw-bold"><?= htmlspecialchars($libraryManager->getAuthorNameById($book['auteur_id'])); ?></td>
                                <td class="col-year fw-bold"><?= htmlspecialchars($book['annee_publication']); ?></td>
                                <td class="col-isbn fw-bold"><?= htmlspecialchars($book['isbn']); ?></td>
                                <td class="col-category fw-bold"><?= htmlspecialchars($libraryManager->getCategoryNameById($book['categorie_id'])); ?></td>
                                <td class="col-details col-actions-size align-middle text-center"><a href="details.php?id=<?= htmlspecialchars($book['id']); ?>" class="btn btn-success border-1 border-white btn-sm btn-details">Détails</a></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-------------Navigation buttons---------------->
        <div class="text-center mt-5">
            <div class="row justify-content-center g-3">
            <!----------Back to list------------->
                <div class="col-12 col-md-6 col-lg-3">
                    <a href="list.php" class="btn btn-primary border-2 border-white px-5">
                        <i class="fas fa-right-from-bracket"></i> Terminé</a>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
</div>

<!----------------Footer inclusion--------------------->
<?php include '../templates/footer.php';