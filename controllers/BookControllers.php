<?php
class BookControllers {
    private $book;

    public function __construct() {
        $this->book = new Book();
    }

    public function index() {
        $boekenArray = $this->book->showAll();
        include 'views/bookList.php';
    }

    public function showBook($id) {
        if (!is_null($id)) {
            $this->book->load($id);
        }

        $boek = $this->book;
        include 'views/bookDetails.php';
    }

    public function newBook($titel, $auteur, $isbn) {
        $result = "";
        if (strlen($titel) > 0 && strlen($auteur) > 0 && strlen($isbn) > 0) {
            $this->book->title = htmlentities($titel);
            $this->book->author = htmlentities($auteur);
            $this->book->isbn = htmlentities($isbn);
            if ($this->book->saveNew()) {
                $result = $this->book->title . " is toegevoegd!";
            } else {
                $result = "FOUT bij toevoegen " . $this->book->title;
            }
        } else {
            $result = "Niet alle eigenschappen gevuld";
        }

        include 'views/newBookResult.php';
    }

    public function deleteBook($id) {
        if (!is_null($id)) {
            $this->book->load($id);

            if($this->book->delete()) {
                $result = "Boek met id {$id} is verwijderd.";
            } else {
                $result = "Boek met id {$id} is niet gevonden.";
            }
            include 'views/deleteBookResult.php';
        }
    }

    public function showUpdateForm($id) {
        if (!is_null($id)) {
            $this->book->load($id);

            $boek = $this->book;

            include 'views/updateBookForm.php';
        }
    }

    public function updateBook($id, $titel, $auteur, $isbn) {
        if (strlen($id) > 0 && strlen($titel) > 0 && strlen($auteur) > 0 && strlen($isbn) > 0) {
            $this->book->id = $id;
            $this->book->title = $titel;
            $this->book->author = $auteur;
            $this->book->isbn = $isbn;
 
            if ($this->book->update()) {
                $message = "Het boek is aangepast!";
            } else {
                $message = "FOUT bij aanpassen van het boek.";
            }
        } else {
            $message = "Niet alle eigenschappen zijn gevuld.";
        }
        include "views/updateBookresult.php";
    }
}