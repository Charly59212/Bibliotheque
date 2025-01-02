<?php

class LibraryManager
{
    protected $connection; // Connection to the database

    // Constructor : initializes the database connection
    public function __construct() {
        $db = new Db(); // Instantiate the Db class
        $this->connection = $db->getConnection(); // Retrieves the PDO object
    }

    // Returns the database connection
    public function getConnection() {
        return $this->connection;
    }    
    
    // Shows books with pagination
    public function getBooksByPage($limit, $offset) {
        $query = "SELECT * FROM livres ORDER BY id ASC LIMIT :limit OFFSET :offset"; // Query to retrieve books with limit and offset
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); // Associates the limit with the :limit parameter
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT); //  Associates the offset with the parameter :offset
        $stmt->execute(); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the results in an associative array
    }

    // Add a new book
    public function addBook(Book $book) {
        $authorId = $this->checkAuthor($book->getAuthorName(), $book->getBiography()); // Check or add the author, and retrieve their ID
        $query = "INSERT INTO livres (titre, auteur_id, annee_publication, isbn, categorie_id, description) 
                  VALUES (:title, :authorId, :publicationYear, :isbn, :categoryId, :description)"; //Request to add the book
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([ // Run query with book data
            ':title' => $book->getTitle(), // Title book
            ':authorId' => $authorId, // Author ID
            ':publicationYear' => $book->getPublicationYear(), // Publication year
            ':isbn' => $book->getIsbn(), // ISBN
            ':categoryId' => $book->getCategoryId(), // Category ID
            ':description' => $book->getDescription(), // Description
        ]);
    }

    // Updating book information
    public function updateBook(Book $book) {
        $authorId = $this->checkAuthor($book->getAuthorName(), $book->getBiography()); // Check or add the author and their biography
        $query = "UPDATE livres SET titre = :title, auteur_id = :authorId, annee_publication = :publicationYear, 
                      isbn = :isbn, categorie_id = :categoryId, description = :description WHERE id = :id"; // Updates book fields
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([ // Execute the query with :
            ':id' => $book->getId(), // Book ID
            ':title' => $book->getTitle(), // Book title
            ':authorId' => $authorId, // Author ID
            ':publicationYear' => $book->getPublicationYear(), // Publication year
            ':isbn' => $book->getIsbn(), // ISBN
            ':categoryId' => $book->getCategoryId(), // Category ID
            ':description' => $book->getDescription(), // Description
        ]);    
    }    

    // Delete a book by its ISBN
    public function deleteBookByIsbn($isbn) {
        $query = "DELETE FROM livres WHERE isbn = :isbn"; // Request to delete a book
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([':isbn' => $isbn]); // Execute query using ISBN
        return $stmt->rowCount() > 0; // Check if a row has been affected
    }

    // Search for books by title or author
    public function searchBooks($title, $authorName) {
        $query = "SELECT * FROM livres WHERE 1=1"; // SQL query with "1=1" which allows the addition of conditions dynamically
        $params = []; // Array to store query parameters
        // 1 : filter the title
        if (!empty($title)) {
            $query .= " AND titre LIKE :title"; // Adds a condition "title contains the search word"
            $params[':title'] = '%' . $title . '%'; // UFind partial match for title
        }
        // 2 : filter the author
        if (!empty($authorName)) {
            $query .= " AND auteur_id IN (SELECT id FROM auteurs WHERE auteur LIKE :authorName)"; // Subquery to filter by author
            $params[':authorName'] = '%' . $authorName . '%'; // Find partial match for author name
        }
        // 3 : Prepare and execute the query
        $stmt = $this->connection->prepare($query); // Prepare the final query
        $stmt->execute($params); // Execute the query passing dynamic parameters
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the results in an associative array
    }

    // Retrieves book details from its ID
    public function getBookDetails($bookId) {
        // Get book details
        $query = "SELECT livres.id, livres.titre, auteur, auteurs.id AS auteur_id, auteurs.biographie, 
                  livres.annee_publication, livres.isbn, categories.nom AS categorie_nom, 
                  categories.id AS categorie_id, livres.description, livres.date_ajout 
                  FROM livres 
                  LEFT JOIN auteurs ON livres.auteur_id = auteurs.id 
                  LEFT JOIN categories ON livres.categorie_id = categories.id 
                  WHERE livres.id = :id"; // Joins the authors and categories tables to obtain complete information          
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([':id' => $bookId]); // Execute query with book ID
        return $stmt->fetch(PDO::FETCH_ASSOC); // Return the results in an associative array
    }    

    // Checks if an author exists or adds it to the database
    private function checkAuthor($authorName, $biography = null) { 
        // Private function only used in libraryManager
        $query = "SELECT id, biographie FROM auteurs WHERE auteur = :name"; // Search for author by name
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([':name' => $authorName]); // Execute the query
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Get the result in an associative array

        if ($result) { // If the author already exists
            if ($biography && $result['biographie'] !== $biography) { // Checks if a biography is provided and if it differs from the one in base
                $updateQuery = "UPDATE auteurs SET biographie = :biography WHERE id = :id"; // Request to update biography
                $updateStmt = $this->connection->prepare($updateQuery); // Prepare the query
                $updateStmt->execute([':biography' => $biography, ':id' => $result['id']]); // Runs update with new data
            }    
            return $result['id']; // Returns the existing author ID
        } else { // If not, add a new author if it does not exist
            $insertQuery = "INSERT INTO auteurs (auteur, biographie) VALUES (:name, :biography)"; // Insert query
            $stmt = $this->connection->prepare($insertQuery); // Prepare the query
            $stmt->execute([':name' => $authorName, ':biography' => $biography]); // Performs insert with name and bio
            return $this->connection->lastInsertId(); // Returns the newly created author ID
        }    
    }    

    // Get all categories
    public function getCategories() {
        $query = "SELECT id, nom FROM categories"; // Query to retrieve categories by category IDs and names
        $stmt = $this->getConnection()->query($query); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return the results in an associative array
    }

    // Retrieves the name of an author by their ID
    public function getAuthorNameById($authorId) {
        $query = "SELECT auteur FROM auteurs WHERE id = :id"; // Query to retrieve author name
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([':id' => $authorId]); // Execute query with author ID
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Get the result in an associative array
        return $result ? $result['auteur'] : 'Auteur inconnu'; // Returns the author name or a default value
    }

    // Retrieves the name of an author by their ID
    public function getCategoryNameById($categoryId) {
        $query = "SELECT nom FROM categories WHERE id = :id"; // Query to retrieve the name of a category
        $stmt = $this->connection->prepare($query); // Prepare the query
        $stmt->execute([':id' => $categoryId]); // Execute query with category ID
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Get the result in an associative array
        return $result ? $result['nom'] : 'Catégorie inconnue'; // Returns the category name or a default value
    }

    // Retrieves the last 5 books added
    public function getLatestBooks($limit = 5) {
        $query = "SELECT livres.id, livres.titre, auteurs.auteur, livres.annee_publication 
                  FROM livres JOIN auteurs ON livres.auteur_id = auteurs.id 
                  ORDER BY livres.date_ajout DESC LIMIT :limit"; // Query to retrieve the latest books
        $stmt = $this->connection->prepare($query); // Execute the query
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT); //  Bind the limit
        $stmt->execute(); // Execute the query
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Return results
    }

    // Count the total number of books
    public function countAllBooks() {
        $query = "SELECT COUNT(*) as total FROM livres"; // Query to count books
        $stmt = $this->connection->query($query); // Execute the query
        $result = $stmt->fetch(PDO::FETCH_ASSOC); // Get the result in an associative array
        return $result['total']; // Returns the total number of books
    }

}