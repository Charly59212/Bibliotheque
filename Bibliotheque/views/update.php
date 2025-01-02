<?php
// Connection settings and verification
require '../config/init.php';

$message = ''; // Success or error message storage variable

// Checking for Book ID
if (isset($_GET['id'])) {
    $bookId = (int) $_GET['id'];

    // Recovering book data
    $bookData = $libraryManager->getBookDetails($bookId);

    if (!$bookData) {
        $message = "Livre introuvable.";
    } else {
        // Verifies sending with POST request of book information
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? ''; // Title
            $authorId = $_POST['author_id'] ?? ''; // Author
            $publicationYear = $_POST['publication_year'] ?? ''; // Publication year
            $isbn = $_POST['isbn'] ?? ''; // ISBN
            $categoryId = $_POST['categoryId'] ?? null; // Category
            $description = $_POST['description'] ?? null; // Description, optional
            $biography = $_POST['biography'] ?? null; // Biography, optional

            // Validation of required fields
            if (!empty($title) && !empty($authorId) && !empty($publicationYear) && !empty($isbn)) {
                // Creating the updateBook object with the provided data
                $updatedBook = new Book($title, $authorId, $publicationYear, $isbn, $categoryId, $description, $biography);

                // Updating book data
                $updatedBook->setId($bookId);

                // Adding the book to the library
                $libraryManager->updateBook($updatedBook);

                // Confirmation message for user
                $message = "Modification réussie ! Veuillez vérifier les informations du livre svp.";

                // Refreshes book data to show changes
                $bookData = $libraryManager->getBookDetails($bookId);
            } else {
                // Error message if required fields are missing
                $message = "Veuillez remplir tous les champs obligatoires.";
            }
        }
    }
} else {
    $message = "ID de livre non spécifié.";
}

// Retrieving categories for the form
$categories = $libraryManager->getCategories();
?>

<div class="container">
    <!------------------------------Title page---------------------------->
    <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle py-2 mx-auto mb-4 w-75">Modifier un livre</h1>

    <!---------Displaying the modification message and checking---------->
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!---------Book Information Update Form---------->
    <form action="" method="POST">
        <div class="card border shadow-sm px-3 py-2">
            <div class="mb-3 fw-bold">
            <!----------Title---------->
                <label for="title" class="form-label">Titre du livre *</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($bookData['titre']) ?>" required>
            </div>
            <!---------Author---------->
            <div class="mb-3 fw-bold">
                <label for="author_id" class="form-label">Nom de l'auteur *</label>
                <input type="text" name="author_id" id="author_id" class="form-control" value="<?= htmlspecialchars($bookData['auteur']) ?>" required>
            </div>
            <!-------Description------->
            <div class="mb-3 fw-bold">
                <label for="description" class="form-label">Description (facultatif)</label>
                <textarea name="description" id="description" class="form-control"><?= htmlspecialchars($bookData['description'] ?? '') ?></textarea>
            </div>
            <!--------Category--------->
            <div class="mb-3 fw-bold">
                <label for="categoryId">Catégorie *</label>
                <select name="categoryId" id="categoryId" class="form-control" required>
            <!------------Showing current category, user can edit it----------------->
                    <option value="" disabled selected></option>
            <!------------Loop to suggest the available categories------------------->
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>"
                            <?= $category['id'] == $bookData['categorie_id'] ? 'selected' : '' // Selection of categories ?>>
                            <?= htmlspecialchars($category['nom']) // Displaying category name ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!----Publication year---->
            <div class="mb-3 fw-bold">
                <label for="publication_year" class="form-label">Année de publication *</label>
                <input type="number" name="publication_year" id="publication_year" class="form-control" value="<?= htmlspecialchars($bookData['annee_publication']) ?>" required>
            </div>
            <!----------ISBN---------->
            <div class="mb-3 fw-bold">
                <label for="isbn" class="form-label">ISBN *</label>
                <input type="text" name="isbn" id="isbn" class="form-control" value="<?= htmlspecialchars($bookData['isbn']) ?>" required>
            </div>
            <!-------Biography------->
            <div class="mb-3 fw-bold">
                <label for="biography" class="form-label">Biographie de l'auteur (facultatif) </label>
                <textarea name="biography" id="biography" class="form-control"><?= htmlspecialchars($bookData['biographie'] ?? '') ?></textarea>
            </div>
        </div>

        <!------------Navigation buttons------------------>
        <div class="text-center my-5">
            <div class="row justify-content-center g-3">
            <!----------Validate changes---------->
                <div class="col-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn btn-success border-2 border-white">
                        <i class="fas fa-plus-circle"></i> Modifier les informations</button>
                </div>

            <!-----------Back to list------------->
                <div class="col-12 col-md-6 col-lg-3">
                    <a class="btn btn-primary border-2 border-white" href="list.php">
                        <i class="fas fa-book"></i> Valider les informations &nbsp; </a>
                </div>
            </div>
        </div>
</div>
</form>
</div>

<!----------------Footer inclusion--------------------->
<?php include '../templates/footer.php';