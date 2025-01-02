<?php
// Connection settings and verification
require '../config/init.php';

// Checks if the book ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die('ID du livre manquant.');
}

// Converting the ID to full ID to ensure validity
$bookId = (int) $_GET['id']; 

// Retrieving book details matching the ID
$bookDetails = $libraryManager->getBookDetails($bookId);

// If no book is found, stop execution
if (!$bookDetails) {
    die('Livre introuvable.');
}

?>

<div class="container">
    <!--------------------------Title page------------------------->
    <h1 id="book-list" class="text-center rounded-3 bg-secondary-subtle py-2 mx-auto mb-4 w-75">Détails du livre</h1>
    <div class="card border shadow-sm px-3 py-2">
        <!------------------Book details table-------------------->
        <table class="table table-bordered table-striped bg-dark-subtle mt-3">
            <!----------Title--------->
            <tr>
                <th>Titre</th>
                <td><?= htmlspecialchars($bookDetails['titre']) ?></td>
            </tr>
            <!---------Author--------->
            <tr>
                <th>Auteur</th>
                <td><?= htmlspecialchars($bookDetails['auteur']) ?></td>
            </tr>
            <!-------Description------>
            <tr>
                <th>Description</th>
                <td><?= htmlspecialchars($bookDetails['description'] ?? 'Non spécifiée') ?></td>
            </tr>
            <!-------Category--------->
            <tr>
                <th>Catégorie</th>
                <td><?= htmlspecialchars($bookDetails['categorie_nom'] ?? 'Non spécifiée') ?></td>
            </tr>
            <!----Publication year---->
            <tr>
                <th>Année de publication</th>
                <td><?= htmlspecialchars($bookDetails['annee_publication']) ?></td>
            </tr>
            <!----------ISBN---------->
            <tr>
                <th>ISBN</th>
                <td><?= htmlspecialchars($bookDetails['isbn']) ?></td>
            </tr>
            <!-------Biography------->
            <tr>
                <th>Biographie</th>
                <td><?= htmlspecialchars($bookDetails['biographie']) ?></td>
            </tr>
            <!----Indentifier ID---->
            <tr>
                <th>Identifiant (ID)</th>
                <td><?= htmlspecialchars($bookDetails['id']) ?></td>
            </tr>
            <!------Date added------>
            <tr>
                <th>Date d'ajout</th>
                <td>
                    <?php
                    // Checking the date added in book details
                    if (isset($bookDetails['date_ajout'])) {
                        // Table for translating English months into French
                        $months = [
                            'January' => 'janvier', 'February' => 'février', 'March' => 'mars', 'April' => 'avril', 'May' => 'mai', 'June' => 'juin',
                            'July' => 'juillet', 'August' => 'août', 'September' => 'septembre', 'October' => 'octobre', 'November' => 'novembre', 'December' => 'décembre'
                        ];

                        // Creating a DateTime object from the retrieved date
                        $date = new DateTime($bookDetails['date_ajout']);

                        // Recovery of the month in English and translation into French
                        $englishMonth = $date->format('F'); // Get the month in English
                        $frenchMonth = $months[$englishMonth]; // Translated into French

                        // Formatted date display: day + month (in French) + year
                        echo $date->format('j ') . ucfirst($frenchMonth) . $date->format(' Y');
                    } else {
                        echo 'Non spécifiée';
                    }
                    ?>
                </td>
            </tr>
        </table>
    </div>

    <!------------Navigation buttons------------------>
    <div class="text-center my-5">
        <div class="row justify-content-center g-3">

            <!-----------Back to list------------->
            <div class="col-12 col-md-6 col-lg-3">
                <a class="btn btn-success border-1 border-white" href="list.php">
                    <i class="fas fa-book mx-1"></i> Retour à la liste &nbsp;</a>
            </div>

            <!----------Back to home------------->
            <div class="col-12 col-md-6 col-lg-3">
                <a class="btn btn-primary border-1 border-white" href="../index.php">
                    <i class="fas fa-home"></i> Retour à l'accueil</a>
            </div>
        </div>
    </div>
</div>

<!----------------Footer inclusion--------------------->
<?php include '../templates/footer.php';