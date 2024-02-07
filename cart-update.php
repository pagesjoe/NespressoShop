<?php
    session_start();

    // If the POST called through the remove form: Remove product
    if(isset($_POST['remove'])){
        $_SESSION['qty'] -= $_SESSION['cart'][$_POST['remove']]['qty'];
        unset($_SESSION['cart'][$_POST['remove']]);
    }
    // If the POST called through the update form: update product
    else{
        // Updating first the cart total number of items
        $_SESSION['qty'] += $_POST['qty']-$_SESSION['cart'][$_POST['id']]['qty'];
        // Updating the product qty in the cart
        $_SESSION['cart'][$_POST['id']]['qty'] = $_POST['qty'];
    }

?>


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
                        <td>
                            <form method="post" >
                                <input class="qty" type="number" name="qty" value="<?php echo $qty?>">
                                <input type="hidden" name="id" value="<?php echo $id?>">
                                <button class="update" type="button" id="<?php echo "u".$id?>" onclick="cartAjax(this.id)">
                                    Update
                                </button>
                            </form>
                        </td>
                        
                        <td>
                            £<?php $sub_total = $qty * $price;
                                $total += $sub_total;
                                echo $sub_total; ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <?php
        if($_SESSION['qty']!=0){
        ?>
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