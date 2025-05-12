function confirmDeleteBook() {
    if (confirm("Are you sure you want to delete this book?")) {
      document.getElementById('delete-book-form').submit();
    }
  }