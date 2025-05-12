<?php

include 'includes/library.php';
$pdo = connectDB();


// Retrieve form data
$title = $_POST['title'] ?? null;
$author = $_POST['author'] ?? null;
$isbn = $_POST['isbn'] ?? null;
$date = $_POST['date'] ?? null;
$image = $_FILES['image'] ?? null;

// Validate input data
if (empty($title) || empty($author) || empty($isbn) || empty($date) ==0) {
    // Display an error message and return
    echo "Please fill out all required fields.";
    return;
}

if (!preg_match("/^\d{10}$/", $isbn)) {
    // Display an error message and return
    echo "Invalid ISBN number.";
    return;
}

if ($date < 1900 || $date > date("Y")) {
    // Display an error message and return
    echo "Invalid year of publication.";
    return;
}

// Sanitize input data
$title = mysqli_real_escape_string($db, $title);
$author = mysqli_real_escape_string($db, $author);
$isbn = mysqli_real_escape_string($db, $isbn);
$date = mysqli_real_escape_string($db, $date);

// Process image upload if necessary
if ($image['error'] == UPLOAD_ERR_OK) {
    $image_ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $image_name = "book_" . $book_id . "." . $image_ext;
    $image_path = "uploads/" . $image_name;
    move_uploaded_file($image['tmp_name'], $image_path);
}

// Insert data into database
$query = "INSERT INTO books (title, author, isbn, date, image) VALUES ('$title', '$author', '$isbn', '$date', '$image_name')";
$stmt = $pdo->query($query);

// Redirect user to confirmation page
header("Location: details.php");
exit;

?>

<!DOCTYPE html>
<html lang="en">
<script src="addbook.js"></script>

  <head>
    <?php include 'includes/metadata.php' ?>
 </head>
  <body>
   <?php include 'includes/header.php' ?>
   <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <div>
        <label for="title"> name of the book</label>
        <input type="text" name="title" id="title" placeholder="Harry potter" required/>
        </div>
        <br>
        <div>
            <label for="author">enter the author do the Book</label>
            <input type="text" name="author" id="author" placeholder="J.K. Rowling" required/>
        </div>
        <br>
        <div>
            <label id="rating"> rate the book </label>
            <input type="range" id="points" name="points" min="0" max="10" />
        </div>
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
          <label for="date">Publication Date</label>
          <input type="date" id="date" name="date" />
        </div>
        <div>
          <label for="isbn">ISBN of the book </label>
          <input type="text" id="isbn" name="isbn" placeholder="0123456789234" required/>
        </div>
        <div>
            <label for="Description">Description</label>
            <textarea name="Description" id="Description" cols="24" rows="11"></textarea>
          </div>
          <label for="bookformat">Book format</label>
          <select name="bookformat" id="bookformat">
            <option value="cover"> hard cover</option>
            <option value="papaer"> paperback</option>
            <option value="epublish"> E-publish</option>
            <option value="mob"> mobile version</option>
            <option value="pdf"> pdf</option>
          </select>
          <p>upload the cover page of the book</p>
          <form action="/coverpage.png">
            <input type="file" id="myFile" name="filename">
          </form>
          <br>
          <div>
            <label for="cover"> Cover image URL</label>
            <input type="text" name="cover" id="cover"/>
        </div>
          <p>upload the ebook</p>
          <form action="/ebook.png">
            <input type="file" id="filename" name="filename" required/>
          </form>
          <div>
            <input type="submit" value="submit"  />
        </div>
</form>
        <?php include 'includes/footer.php' ?>
      </body>
</html>
