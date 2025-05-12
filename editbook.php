
<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Validate the input fields
  $errors = [];

  if (empty($_POST['title'])) {
    $errors[] = 'Title is required.';
  }

  // Validate other fields here

  if (count($errors) > 0) {
    // Display error message and redirect back to form
    $_SESSION['errors'] = $errors;
    header('Location: editbook.php?id=' . $bookId);
    exit();
  }

  // Update the book information in the database
  $stmt = $pdo->prepare('UPDATE books SET title = ?, author = ?, description = ?, category = ? WHERE id = ? AND user_id = ?');
  $stmt->execute([$_POST['title'], $_POST['author'], $_POST['description'], $_POST['category'], $bookId, $userId]);

  // Update the cover image if a new file is uploaded
  if ($_FILES['cover_image']['error'] === UPLOAD_ERR_OK) {
    // Process the cover image file here
    $coverImageFilename = 'new_cover_image.jpg';

    $stmt = $pdo->prepare('UPDATE books SET cover_image = ? WHERE id = ? AND user_id = ?');
    $stmt->execute([$coverImageFilename, $bookId, $userId]);
  }

  // Update the ebook file if a new file is uploaded
  if ($_FILES['ebook']['error'] === UPLOAD_ERR_OK) {
    // Process the ebook file here
    $ebookFilename = 'new_ebook.pdf';

    $stmt = $pdo->prepare('UPDATE books SET ebook = ? WHERE id = ? AND user_id = ?');
    $stmt->execute([$ebookFilename, $bookId, $userId]);
  }

  // Redirect to the bookshelf page
  header('Location: index.php');
  exit();
}
?>

<!DOCTYPE html>
<?php include 'includes/metadata.php'?>
<html lang="en">
    <body>
<?php include 'includes/header.php';?>
<form action="editbook.php" id="<?php echo $bookId; ?>" method="POST" >
  <?php
    // Display error messages if there are any
    if (isset($_SESSION['errors'])) {
      foreach ($_SESSION['errors'] as $error) {
        echo '<div class="error">' . $error . '</div>';
      }
      unset($_SESSION['errors']);
    }
  ?>
  <label for="title">Title:</label>
  <input type="text" name="title" value="<?php echo htmlspecialchars($book['title'] ?? null); ?>">

  <label for="author">Author:</label>
  <input type="text" name="author" value="<?php echo htmlspecialchars($book['author']?? null); ?>">

  <label for="description">Description:</label>
  <textarea name="description"><?php echo htmlspecialchars($book['description']); ?></textarea>

  <label for="category">Category:</label>
  <select name="category">
    <option value="Fiction" <?php if ($book['category'] === 'Fiction') echo 'selected'; ?>>Fiction</option>
    <option value="Non-Fiction" <?php if ($book['category'] === 'Non-Fiction') echo 'selected'; ?>>Non-Fiction</option>
    <option value="Science Fiction" <?php if ($book['category'] === 'Science Fiction') echo 'selected'; ?>>Science Fiction</option>
    <option value="Mystery" <?php if ($book['category'] === 'Mystery') echo 'selected'; ?>>Mystery</option>
  </select>

  <label for="cover_image">Cover Image:</label>
  <input type="file" name="cover_image">

  <label for="ebook">Ebook:</label>
  <input type="file" name="ebook">

  <button type="submit">Update</button>
</form>
<?php include 'includes/footer.php';?>
</body>
</html>
