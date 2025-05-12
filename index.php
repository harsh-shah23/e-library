<!DOCTYPE html>
<html lang="en">
  <?php include 'includes/metadata.php' ?>
    <body>
       <?php include 'includes/header.php' ?>

        <header>
            <div>
                <img src="home.jpg" alt="home" width="300" height="300" />
            </div>
                <h3> Good Morning</h3>
             <label for="username">username:</label>
             <input type="text" name="username" id="username" placeholder="harsh shah" />   
            <h2>Display Options</h2>
        </header>
        <label for="Sort"> Sort by</label>
        <select name="Sort" id="Sort">
            <option value="date added"> date added</option>
            <option value="latest">latest</option>
        </select>
        <br>
        <div>
            <div>
            <img src="richdad.jpg" alt="richdad" width="450" height="500">
        </div>
        <div>
            <label id="bookname">Rich Dad Poor Dad</label>
        </div>
            <label id="author"> Robert Kiyosaki and Sharon Lechter</label>
            <div>
            <a href="editbook.php">edit book</a>
            <a href="deletebook.php">delete book</a>
            <a href="details.php"> Book details</a>
        </div>
        </div>

        <br>
        <div>
            <div>
           <img src="harrypotter.jpeg" alt="harrypotter" width="450" height="500">
            </div>
            <div>
            <label id="bookname1">Harry Potter and the Cursed Child</label>
        </div>
        <div>
            <label id="author1">J.K. Rowling</label>
        </div>
            <a href="editbook.php">edit book</a>
            <a href="deletebook.php">delete book</a>
            <a href="details.php"> Book details</a>
        
        </div>  
          <?php include 'includes/footer.php' ?>
    </body>
</html>
