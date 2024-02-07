<?php 
    session_start(); 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        $link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $pass_hash = password_hash($pass,PASSWORD_DEFAULT);
        $query = "INSERT into user (fname,lname,email,password) 
                    values ('$fname','$lname','$email','$pass_hash')";
        mysqli_query($link,$query);
        header("Refresh:4;signin.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register-style.css">
    <title>Document</title>
</head>
<body>

    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <img src="images/Nespresso.png" alt="">
                </a>
            </div>
        </div>
    </nav>
    
    <?php 
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        ?>
            <div class="success">
            <P>
                Registered Successfully<br>Redirecting you...
            </P>
            </div>
            <?php 
            exit;
        }
    ?>

    <div class="form-sec">
        <form action="register.php" method="post">
            <div class="row-input">
                <label for="">First Name: </label>
                <input type="text" name="fname" id="fname" required>
            </div>
            <div class="row-input">
                <label for="">Last name: </label>
                <input type="text" name="lname" id="lname" required>
            </div>
            <div class="row-input">
                <label for="">Email Address: </label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="row-input">
                <label for="">Password: </label>
                <input type="text" name="pass" id="pass" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
    
</body>

<script>

</script>
</html>