<?php
include 'includes/library.php';
$pdo = connectDB();

$search_term = isset($_GET['search']) ? $_GET['search'] : '';

// Sanitize search term
$search_term = mysqli_real_escape_string($author, $search_term);

// Build SQL SELECT statement
$sql = "SELECT * FROM `assignment3` WHERE title LIKE '%$search_term%' ORDER BY title";

// Execute SQL query
$result = mysqli_query($author, $sql);

// Display search results
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/metadata.php'?>
    <body>
     <?php include 'includes/header.php'?>
        <h3> Search a book</h3>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <label for="isbn">ISBN</label>
        <input type="text" id="isbn" name="isbn" placeholder="0123456789263" required />

        <div>
            <label for="Genre"> Genre</label>
            <select name="Genre" id="Genre">
                <option value="Science fiction">Sci-fi</option>
                <option value="Politics">Politics</option>
                <option value="Comedy">Comedy</option>
                <option value="Science">Science</option>
                <option value="adventure">Adventure</option>
            </select>
        </div>
        <div>
            <label for="author">enter the author do the Book</label>
            <input type="text" name="author" id="author" placeholder="J.K. Rowling" required/>
        </div>
        <div>
            <label for="title"> name of the book</label>
            <input type="text" name="title" id="title" placeholder="Harry potter" required/>
            </div>
            <div>
                <input type="submit" value="submit" onclick="lsRememberMe()" />
            </div>
</form>
           <?php include 'includes/footer.php' ?>
    </body>
    </html>
  