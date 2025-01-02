<?php

class Book {
    // Private properties
    private $id;
    private $title;
    private $authorName;
    private $publicationYear;
    private $isbn;
    private $categoryId;
    private $description;
    private $biography;

    // Constructor
    public function __construct($title, $authorName, $publicationYear, $isbn, $categoryId = null, $description = null, $biography = null) {
        $this->title = $title;
        $this->authorName = $authorName;
        $this->publicationYear = $publicationYear;
        $this->isbn = $isbn;
        $this->categoryId = $categoryId;
        $this->description = $description;
        $this->biography = $biography;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthorName() {
        return $this->authorName;
    }

    public function getPublicationYear() {
        return $this->publicationYear;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getBiography() {
        return $this->biography;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setAuthorName($authorName) {
        $this->authorName = $authorName;
        return $this;
    }

    public function setPublicationYear($publicationYear) {
        $this->publicationYear = $publicationYear;
        return $this;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
        return $this;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setBiography($biography) {
        $this->biography = $biography;
        return $this;
    }
    
}