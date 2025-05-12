function validateForm(event) {
    // prevent form submission
    event.preventDefault();
  
    // get form fields
    const usernameField = document.getElementById('username');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('confirm-password');
  
    // get form values
    const username = usernameField.value.trim();
    const email = emailField.value.trim();
    const password = passwordField.value;
    const confirmPassword = confirmPasswordField.value;
  
    // validate username
    if (username.length === 0) {
      usernameField.classList.add('error');
      return;
    } else {
      usernameField.classList.remove('error');
    }
  
    // validate email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
      emailField.classList.add('error');
      return;
    } else {
      emailField.classList.remove('error');
    }
  
    // validate password
    if (password.length < 8) {
      passwordField.classList.add('error');
      return;
    } else {
      passwordField.classList.remove('error');
    }
  
    // validate confirm password
    if (password !== confirmPassword) {
      confirmPasswordField.classList.add('error');
      return;
    } else {
      confirmPasswordField.classList.remove('error');
    }
  
    // submit form
    document.getElementById('register-form').submit();
  }
  $(document).ready(function() {
    // Retrieve book information and pre-populate the Add Book form fields
    $("#lookup-btn").click(function(event) {
      event.preventDefault();
      var searchQuery = $("#book-search").val();
      var url = "https://www.googleapis.com/books/v1/volumes?q=" + searchQuery;
  
      $.ajax({
        url: url,
        dataType: "json",
        success: function(data) {
          if (data.totalItems > 0) {
            var book = data.items[0].volumeInfo;
            $("#book-title").val(book.title);
            $("#book-author").val(book.authors ? book.authors[0] : "");
            $("#book-isbn").val(book.industryIdentifiers ? book.industryIdentifiers[0].identifier : "");
          } else {
            alert("Book not found.");
          }
        },
        error: function() {
          alert("Error retrieving book information.");
        }
      });
    });
  
    // Submit the Add Book form
    $("#add-book-form").submit(function(event) {
      event.preventDefault();
      // Code to add the book to the library
    });
  });
  