<?php
$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$errors = [];

if (isset($_POST['submit']))
 {
    require_once 'includes/library.php';
    $pdo = connectDB();
    $query = $pdo->prepare('SELECT * FROM assignment3 WHERE username = ?');
    $query->execute([$username]);
    $user = $query->fetch();

    if (!$user) 
    {
        $errors['user'] = true;
    } else
     {
        if (password_verify($password, $user['password']))
        {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['id'];
            header('Location: index.php');
            exit();
        } else
        {
            $errors['login'] = true;
        
       }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'includes/metadata.php'?>
    <body>
        <main>
        <?php include 'includes/header.php'?>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST" autocomplete="off">
        <div>
            <img src="avatar.jpg" alt="avatar" width="300" height="300">
        </div>
        <div>
            <label for="username">username:</label>
            <input type="text" name="username" id="username" placeholder="harsh shah"  value = "<?=$username;?>" required/>
        </div>
        <div>
            <label id="password"> enter password:</label>
            <input type="password" name="password" id="password"   required/> 
        </div>
        <div>
                <span class="<?=!isset($errors['user']) ? 'hidden' : "";?>">*That user doesn't exist</span>
                <span class="<?=!isset($errors['login']) ? 'hidden' : "";?>">*Incorrect login info</span>
        </div>
        <div>
        <input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe">Remember me</label> 
        </div>
        <div> 
            <button type = "submit" id="submit" name="submit">Log In</button>
        </div>
        </form>
        <?php include 'includes/footer.php' ?>
</main>
    </body>
 </html>