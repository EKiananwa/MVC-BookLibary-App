<?php   

class Book {
    
    public $id = null;
    public $title = "";
    public $author = "";
    public $isbn = "";

    public function load($id) {
        
        global $db;

        $query = "SELECT * FROM mvc_boeken WHERE id =" . $id;

        $result = mysqli_query ($db, $query);

        if (mysqli_num_rows($result) == 1){

            $row = mysqli_fetch_assoc($result);

            $this->id = $id;
            $this->title = $row['title'];
            $this->author = $row['author'];
            $this->isbn = $row['isbn'];

        } //else {
        //     echo ("Kan het boek met id {$id} niet vinden");
        // }
    }

    public function saveNew(){
        
        global $db;

        if(is_null($this->id)) {
            
            $this->title = mysqli_real_escape_string($db, $this->title);
            $this->author = mysqli_real_escape_string($db, $this->author);

            $query = "INSERT INTO mvc_boeken (title, author, isbn)";
            $query .= " VALUES ('{$this->title}', '{$this->author}', '{$this->isbn}')";
            
            if (mysqli_query($db, $query)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function showAll(){
            
        global $db;

        $result = mysqli_query($db, "SELECT id FROM mvc_boeken ORDER BY id");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $bookAdd = new Book();
                $bookAdd->load($row['id']);
                $boeken[] = $bookAdd;
            }
        }
        return $boeken;
    }

    public function delete() {
        global $db;

        if (!is_null($this->id)) {
            $query = "DELETE FROM mvc_boeken WHERE id = " . $this->id;

            if (mysqli_query($db, $query)) {
                return true;
            }
        }
        return false;
    }
    
    public function update() {
        global $db;

        if (!is_null($this->id)) {
            $this->title = mysqli_real_escape_string($db, $this->title);
            $this->author = mysqli_real_escape_string($db, $this->author);
            $this->isbn = mysqli_real_escape_string($db, $this->isbn);

            $query = "UPDATE mvc_boeken SET title = '{$this->title}', author = '{$this->author}', isbn = '{$this->isbn}' WHERE id = {$this->id} ";

            if (mysqli_query($db, $query)) {
                return true;
            } else {
                echo $query . "<br>";
                echo mysqli_error($db);
            }
        }
        return false;
    }
}