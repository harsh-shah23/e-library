<?php
  // Start session
  session_start();

  // Include database connection
  $pdo = connectDB();

  // Get book ID from URL
  $bookId = $_GET['id'];

  // Check if user owns the book
  $userId = $_SESSION['user']['id'];
  $query = "SELECT * FROM books WHERE id = $bookId AND user_id = $userId";
  $result = mysqli_query($conn, $query);
  $book = mysqli_fetch_assoc($result);

  if (!$book) {
    $_SESSION['errors'][] = "You can only delete your own books.";
    header("Location: index.php");
    exit();
  }

  // Check if delete button was clicked
  if (isset($_POST['delete'])) {
    // Delete book from database
    $query = "DELETE FROM books WHERE id = $bookId";
    mysqli_query($pdo, $query);

    // Redirect to index page
    header("Location: index.php");
    exit();
  }
?>

<script src="deletebook.js"></script>

<!-- Book deletion form -->
<form id="delete-book-form" action="deletebook.php?id=<?php echo $book['id']; ?>" method="post">
  <a href="#" onclick="confirmDeleteBook();">Delete</a>
  <input type="hidden" name="delete" value="true">
</form>

<!-- Account deletion confirmation dialog -->
<script>
  function confirmDeleteAccount() {
    if (confirm("Are you sure you want to delete your account? This cannot be undone.")) {
      document.getElementById('delete-account-form').submit();
    }
  }
</script>

<!-- Account deletion form -->
<form id="delete-account-form" action="deleteaccount.php" method="post">
  <a href="#" onclick="confirmDeleteAccount();">Delete Account</a>
  <input type="hidden" name="delete" value="true">
</form>
