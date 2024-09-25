<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3><a href="?voegtoe">voegtoe</a></h3>
    <?php
    require 'inc/config.inc.php';
    require_once 'models/Book.php';
    require_once 'controllers/BookControllers.php';

    $ctr = new BookControllers();

    if (isset($_GET['verwijder'])) {
        $ctr->deleteBook($_GET['verwijder']);
    }

    if (isset($_POST['submit'])){
        $ctr->newBook($_POST['naam'], $_POST['auteur'], $_POST['isbn']);
    } 

    if (isset($_GET['pasaan'])) {
        if (isset($_POST['aanpasKnop'])){
            $ctr->updateBook($_GET['pasaan'], $_POST['naam'], $_POST['auteur'], $_POST['isbn']);
        } else {
            $ctr->showUpdateForm($_GET['pasaan']);
        }
    }

    if (isset($_GET['voegtoe'])) {
        ?>
        <h3>Boek toevoegen:</h3>
        <form method="post" action="">
            <p>Titel: <input type="text" name="naam" required></p>
            <p>Auteur: <input type="text" name="auteur" required></p>
            <p>ISBN: <input type="number" name="isbn" required></p>
            <p><input type="submit" name="submit" value="Voeg toe"></p>
        </form>
        <?php
    } if (isset($_GET['id'])) {
        $ctr->showBook($_GET['id']);
    } else {
        $ctr->index();
}
    ?>
</body>
</html>