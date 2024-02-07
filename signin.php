<?php
    session_start();

    $sign_error = '';
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        

        // Conecting to database
        $link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');

        //Selecting query with the entered email 
        $sql = "SELECT * from user where email = '$email'";
        $query = mysqli_query($link,$sql);
        $result = mysqli_fetch_assoc($query);

        //Checking if this email exists
        if(mysqli_num_rows($query)==1){

            // Verify Password
            $pass_hash = $result['password'];
            if(password_verify($pass,$pass_hash)){
                //If Yes, set session variables
                $_SESSION['loggedin'] = true;
                $_SESSION['fname'] = $result['fname'];
                $_SESSION['userid'] = $result['id'];
                header('Location:index.php');
            }
            else{
                $sign_error = "Invalid Password";
            }
        }
        else{
            $sign_error = 'Invalid email';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin-style.css">
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

    <div class="form-sec">
        <form action="signin.php" method="post">
            <div class="row-input">
                <label for="">Email: </label>
                <input type="text" name="email" id="email" required>
            </div>
            <div class="row-input">
                <label for="">Password: </label>
                <input type="text" name="pass" id="pass" required>
            </div>
            <div style="color:red;">
                <?php echo $sign_error;?>
            </div>
            <button type="submit">LOG IN</button>
        </form>
        <P>DON'T HAVE ACCOUNT?</P>
        <a href="register.php"><BUTTon>Register</BUTTon></a>
    </div>
</body>
</html>