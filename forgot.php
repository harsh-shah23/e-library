
<!DOCTYPE html>
<html lang="en">
   <?php include 'includes/metadata.php' ?>
    <body>
       <?php include 'includes/header.php' ?>
        <title> Forgot password </title>
        <img src="avatar.jpg" alt="avatar" width="300" height="300"/>
        <div> 
            <label for="username">username:</label>
            <input type="text" name="username" id="username" placeholder="harsh shah" required/>
        </div>
        <div>
            <label for="email">Enter your email:</label>
            <input type="email" id="email" name="email" placeholder="harsh@trentu.ca" required/>
        </div>
        <div>
            <label for="password"> enter password:</label>
            <input type="password" name="newpass" id="password" required/> 
        </div>
        <div>
            <label for="password1"> confirm password:</label>
            <input type="password" name="newpass" id="password1" required/>
        </div>
        <div>
            <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label>
            </div>
            <div>
                <button type="button">submit</button>
        </div>
        <?php include 'includes/footer.php' ?>
    </body>
    </html>
