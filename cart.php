<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart-style.css">
    <!--adding font awesome icons library-->
    <script src="https://kit.fontawesome.com/28cbcae3e4.js" crossorigin="anonymous"></script>
    <title>Nespresso</title>
</head>

<body>
    <!--Navbar Section-->
    <?php include('header.php'); ?>
                 
    
    <!-- Cart Section -->
    <section class="cart-sec">
        <div class="cart-div">
            
            <table class="cart-table">
                <tr class="table-header">
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <!-- Start loading cart products if qty>0 -->
                <?php 
                if($_SESSION['qty']!=0){
                    $total=0;
                    foreach($_SESSION['cart'] as $id=>$product){
                        $image = $product['image'];
                        $name = $product['name'];
                        $price = $product['price'];
                        $qty = $product['qty'];
                ?>
                        <tr>
                            <!-- Cart Item -->
                            <td>
                                <div class="cart-item">
                                    <img src="images/<?php echo $image?>" alt="">
                                    <div class="cart-item-details">
                                        <!-- <p><?php echo $id?></p> -->
                                        <p><?php echo $name?></p>
                                        <p>£<?php echo $price?></p>
                                    </div>
                                    <form method="post">
                                        <input type="hidden" name="remove" value= "<?php echo $id?>"></input>
                                        <button type="button" value="<?php echo $id?>"
                                            class="remove" id="<?php echo "r".$id?>" onclick="cartAjax(this.id)">
                                            X
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <!-- UPdate Cart Item -->
                            <td>
                                <form method="post" >
                                    <input class="qty" type="number" name="qty" 
                                        value="<?php echo $qty?>" min="1">
                                    <input type="hidden" name="id" value="<?php echo $id?>">
                                    <button class="update" type="button" id="<?php echo "u".$id?>" 
                                        onclick="cartAjax(this.id)">
                                        Update
                                    </button>
                                </form>
                            </td>

                            <!-- Cart Item sub total price -->
                            <td>
                                £<?php $sub_total = $qty * $price;
                                    $total += $sub_total;
                                    echo $sub_total; ?>
                            </td>
                        </tr>
                <?php
                    }
                    $_SESSION['total'] = $total;
                }
                ?>
            </table>

            <?php
            if($_SESSION['qty']!=0){
            ?>
                <!-- Total Section -->
                <div class="total">
                    <p class="total-text">Total</p>
                    <p class="total-number">£<?php echo $total?></p>
                </div>

                <!-- Checkout Section -->
                <a href="checkout.php" class="checkout-link">
                    <button class="checkout-btn">Confirm Checkout</button>
                </a>

            <?php
            }?>
            
        </div>
    </section>
</body>
</html>

<script>
    // AJAX code for updating the cart
    function cartAjax(buttonId){
        // handle clicking the form button by sending request to the cartUpdate.php page
        req = new XMLHttpRequest();
        req.open("POST","cart-update.php",true);
        req.onreadystatechange = updateCart;

        // Create a form object to send
        myForm = document.getElementById(buttonId).parentElement;
        formData = new FormData(myForm);

        // Send form
        req.send(formData);
    }

    
    function updateCart(){
        // Updating the whole body from the response text
        var cartBody = document.body;
        cartBody.innerHTML = req.responseText;
    }
</script>