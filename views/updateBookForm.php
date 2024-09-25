<form method="post" action="index.php?pasaan=<?php echo $boek->id; ?>">
    <p>Titel: <input type="text" name="naam" value="<?php echo htmlentities($boek->title); ?>" required></p>
    <p>Auteur: <input type="text" name="auteur" value="<?php echo htmlentities($boek->author); ?>" required></p>
    <p>ISBN: <input type="number" name="isbn" value="<?php echo htmlentities($boek->isbn); ?>" required></p>
    <p><input type="submit" name="aanpasKnop" value="Pas Aan"></p>
</form>