<?php
    session_start();

    // Incrementing the session cart qty
    $_SESSION['qty'] += $_POST['qty'];

    $id = $_POST['id'];

    // Getting product details from database to add it to the cart
    $link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');
    $query = mysqli_query($link,"SELECT * FROM product WHERE id=$id");
    $product = mysqli_fetch_assoc($query);

    // Updating the session cart array
    // Check if the cart array is constructed first
    if(isset($_SESSION['cart'])){

        // If the product is already in the cart, Increment the qty
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['qty'] += $_POST['qty'];
        }
        // If the product is not in the cart already, Add the product array to the cart array
        else{
            // Making a new array of product details and add it to the cart array
            $_SESSION['cart'][$product['id']] = array(
                                                    'image'=>$product['image'],
                                                    'name'=>$product['name'],
                                                    'price'=>$product['price'],
                                                    'qty'=>$_POST['qty']);
        }
    }
    // If the cart array is not set, construct the cart array and add the product array to it
    else{
        // Making a new array of product details and add it to the cart array
        $_SESSION['cart'][$product['id']] = array(
                                                'image'=>$product['image'],
                                                'name'=>$product['name'],
                                                'price'=>$product['price'],
                                                'qty'=>$_POST['qty']);
    }
    // Response text to be updated
    echo "($_SESSION[qty])";
?>