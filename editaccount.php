<?php 
$username= $_POST['username']?? null;
$password= $_POST['password'] ?? null;
 
$errors=array();
include 'includes/library.php';

$pdo=connectDB();
session_start();
$query= "SELECT * FROM `assignment3` WHERE id='username'";

$statement= $pdo->prepare($query);
$statement->execute();
$result= $statement->fetchAll();



if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    header("location: index.php");
    exit();
}



?>

<!DOCTYPE html>
<html>
    <head>
        <?php include 'includes/header.php'?>
        <body>
            <?php include 'includes/metadata.php'?>
        <title>edit account</title>
        <form action="<?=htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
        <div>
        <label for="username">username</label>
     <input type="text" name="username" id="username" value = "<?=$username;?>">
</div>
<div>
    <label for="password">Password</label>
    <input type="password" name="password" id="password" placeholder="Enter new password">
</div>
<div>
    <button type="submit" id="submit">Update</button>
</div>
</form>
<?php include 'includes/footer.php'?>
</body>
</html>