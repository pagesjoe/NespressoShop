<?php 
    session_start();

    // If the user is logged in
    if(isset($_SESSION['loggedin'])){
        // Connecting to database
        $link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');

        // Inserting new order to database table orders
        $date = date('Y-m-d H:i:s');
        $userid = $_SESSION['userid'];
        $price = $_SESSION['total'];
        $items = count($_SESSION['cart']);


        $query = "INSERT into orders (date,userid,price,items) 
                        values ('$date','$userid','$price','$items')";
        mysqli_query($link,$query);


        // Inserting products purchased one by one into database table product_purchase

        // Getting order id first from database
        $query = "SELECT id FROM `orders` WHERE date = '$date'
        and userid = '$userid'";
        $orderid = mysqli_fetch_row(mysqli_query($link,$query))[0];

        foreach($_SESSION['cart'] as $id=>$product){
            $productid = $id;

            $query = "INSERT into product_purchase (productid,userid,orderid) 
                            values ($productid,'$userid','$orderid')";
            mysqli_query($link,$query);
        }

        // Emptying the cart
        $_SESSION['qty'] = 0;
        $_SESSION['cart'] = Null;

        
        header("Refresh:2; index.php");  
        echo "Order submitted Successfully";
        exit;
    }
    // if the user not logged in, redirect to sign in
    else{
        header("Location:signin.php");  
        exit;
    }
    
?>
