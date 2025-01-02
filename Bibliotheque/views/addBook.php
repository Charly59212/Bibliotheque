<?php
// Connection settings and verification
require '../config/init.php';

$message = ''; // Success or error message storage variable

// Verifies sending with POST request of book information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieving form data
    $title = $_POST['title'] ?? ''; // Title
    $authorName = $_POST['authorName'] ?? '';  // Author
    $publicationYear = $_POST['publicationYear'] ?? ''; // Publication year
    $isbn = $_POST['isbn'] ?? ''; // ISBN
    $categoryId = $_POST['categoryId'] ?? null; // Category
    $description = $_POST['description'] ?? null; // Description, optional
    $biography = $_POST['biography'] ?? null; // Biography, optional

    // Validation of required fields
    if (!empty($title) && !empty($authorName) && !empty($publicationYear) && !empty($isbn)) {
        // Creating the Book object with the provided data
        $book = new Book($title, $authorName, $publicationYear, $isbn, $categoryId, $description, $biography);

        // Adding the book to the library
        $libraryManager->addBook($book);

        // Confirmation message for user
        $message = "Livre ajouté avec succès ! Ajoutez un autre livre ou explorez la bibliothèque.";
    } else {
        // Error message if required fields are missing
        $message = "Veuillez remplir tous les champs obligatoires.";
    }
}

// Retrieving categories for the form
$categories = $libraryManager->getCategories();
?>

<div class="container">
    <!-----------------------Title page----------------------->
    <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mx-auto mb-4 w-75">Ajouter un livre</h1>

    <!---------Displaying the add and verify message---------->
    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <!-------------Book information entry form--------------->
    <form method="POST" action="">
        <div class="card border shadow-sm px-3 py-2">
            <!----------Title--------->
            <div class="mb-3 fw-bold">
                <label for="title" class="form-label">Titre du livre *</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <!---------Author--------->
            <div class="mb-3 fw-bold">
                <label for="authorName" class="form-label">Nom de l'auteur *</label>
                <input type="text" name="authorName" id="authorName" class="form-control" required>
            </div>
            <!-------Description------>
            <div class="mb-3 fw-bold">
                <label for="description" class="form-label">Description (facultatif)</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <!--------Category-------->
            <div class="mb-3 fw-bold">
                <label for="categoryId" class="form-label">Catégorie *</label>
                <select name="categoryId" id="categoryId" class="form-control" required>

            <!----Default option disabled, user must choose a category---->
                    <option value="" disabled selected>-- Sélectionnez une catégorie --</option>

            <!---------Loop to suggest the available categories----------->
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>">
                            <?= htmlspecialchars($category['nom']) // Shows category name ?> 
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!----Publication year----->
            <div class="mb-3 fw-bold">
                <label for="publicationYear" class="form-label">Année de publication *</label>
                <input type="number" name="publicationYear" id="publicationYear" class="form-control" required>
            </div>
            <!-----------ISBN---------->
            <div class="mb-3 fw-bold">
                <label for="isbn" class="form-label">ISBN *</label>
                <input type="text" name="isbn" id="isbn" class="form-control" required>
            </div>
            <!--------Biography------->
            <div class="mb-3 fw-bold">
                <label for="biography">Biographie de l'auteur (facultatif)</label>
                <textarea name="biography" id="biography" class="form-control"></textarea>
            </div>
        </div>

        <!------------Navigation buttons------------------>
        <div class="text-center my-5">
            <div class="row justify-content-center g-3">
                <div class="col-12 col-md-6 col-lg-3">
                    <button type="submit" class="btn btn-success border-2 border-white px-4">
                        <i class="fas fa-plus-circle"></i> Ajouter un livre &nbsp;</button>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <a class="btn btn-primary border-2 border-white px-4" href="list.php">
                        <i class="fas fa-book"></i> Retour à la liste &nbsp;</a>
                </div>
            </div>
        </div>
    </form>
</div>

<!-----------------Footer inclusion--------------------->
<?php include '../templates/footer.php';