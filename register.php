<?php
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$email = $_POST['email']?? null;
$name= $_POST['name']?? null;

$errors= array();

if(isset($_POST['submit'])) 
{
    include 'includes/library.php';
    $pdo = connectDB();
    $query = "SELECT id FROM `assignment3`";
    $stmt = $pdo->query($query);
    
    
    if(isset($_POST['submit']))
    {
        if(!isset($username) || strlen($username)===0)
        $errors['username'] = true;
    }
 
        if(empty($email))
        {$errors['email'] = true;}

        if(empty($name) || strlen($name)===0)
        {$errors['name'] = true;}

        if(count($errors)=== 0)
        {
            $query = "INSERT INTO assignment3 (username, password, email, name) values (?,?,?,?)";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT), $email, $name]);

            header("Location: login.php");
            exit();
          
        } 
}    

?>
<!DOCTYPE html>
<html>
    <head>
   <?php include 'includes/metadata.php' ?>
   <script src ="scripts/register.js"></script>
</head>
<body>
    <?php include 'includes/header.php'?>

    <section class="register">
        <h2>Register</h2>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
    <div>
        <label for="username">username:</label>
        </div>
        <div>
        <input type="text" name="username" id="username" placeholder="harsh shah" required=""  >
    </div>
    <div>
        <label for="name">name:</label>
    </div>
    <div>
        <input type="text" name="name" id="name" placeholder="harsh" required="" >
    </div>
    <div>
        <label for="email">Enter your email:</label></div>
        <div>
        <input type="email" id="email" name="email" placeholder="harsh@trentu.ca" required="">
    </div>
    <div>
        <label id="pass"> enter password:</label></div>
        <div>
        <input type="password" name="pass" > 
    </div>
    <div>
        <label id="password"> confirm password:</label></div>
        <div>
        <input type="password" name="password" required="" >
    </div>
    <div>
        <span id="password-strength"></span>
</div>

    <div>
        <input type="checkbox" value="lsRememberMe" id="rememberMe"> 
        <label for="rememberMe">Remember me</label></div>
        <div>
        <button type = "submit" id="submit" name="submit">Log In</button>
    </div>
</form>
    </section>

    <?php include 'includes/footer.php' ?>
</body>
</html>

