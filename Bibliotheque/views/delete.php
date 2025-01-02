<?php
// Connection settings and verification
require '../config/init.php';
?>

<div class="container">
    <div class="d-flex flex-column justify-content-center align-items-center">

    <!--------------------------Title page------------------------>
        <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle pt-1 pb-2 mx-auto mb-4 w-75">Suppression du livre</h1>

        <?php
        // Check if the ISBN is passed as a parameter
        if (isset($_GET['isbn'])) {
            $isbn = $_GET['isbn']; // Retrieving the ISBN

            // deletion of the book
            if ($libraryManager->deleteBookByIsbn($isbn)) {
                // Confirmation message on successful deletion
                echo "<p class='text-center fs-4 text-black fw-bold mt-5 pt-5'>Le livre avec l'ISBN <span class='text-danger fw-bold'>$isbn</span> a été supprimé avec succès.</p>";
            } else {
                // Error message if no matching book found
                echo "<p class='text-center fs-4 text-danger fw-bold mt-5 pt-5'>Erreur : Aucun livre trouvé avec cet ISBN.</p>";
            }
        } else {
            // Error message if no ISBN is specified
            echo "<p class='text-center fs-4 text-warning fw-bold'>Erreur : Aucun ISBN spécifié.</p>";
        }
        ?>

        <!-------------Navigation buttons---------------->
        <div class="text-center my-5">
            <!----------Back to list------------->
            <div class="row justify-content-center g-3">
                <div>
                    <a href="list.php" class="btn btn-success border-2 border-white px-5">
                        <i class="fas fa-check"></i> Ok
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!--------------------Footer inclusion------------------------->
<?php include '../templates/footer.php'; ?>