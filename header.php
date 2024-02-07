<?php

// Setting account
if(isset($_SESSION['loggedin'])){
    if($_SESSION['loggedin']){
        $signin_txt = $_SESSION['fname'];
    }
}
else{
    $signin_txt = 'SIGN IN';
}

// Setting the session cart quantity to 0 if not set before
if(!isset($_SESSION['qty'])){
    $_SESSION['qty'] = 0;
}
?>


<!--Navbar Section-->
    <nav>
        <div class="nav-container">
            <div class="logo">
                <a href="index.php">
                    <img src="images/Nespresso.png" alt="">
                </a>
            </div>
            <ul>
                <li class="li-signin">
                    <!-- If logged in, make the li as a button droplist with sign out option -->
                    <?php 
                    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'])){
                    ?>
                        <button class="signin-button" onclick="signin_droplist()">
                            <div class="nav-box nav-box-signin">
                                <i class="fa-regular fa-user nav-box-signin-icon"></i>
                                <span class="nav-box-text nav-box-signin-text">
                                    <?php echo $signin_txt; ?>
                                </span>
                            </div>
                        </button>
                    <!-- IF not logged in, make the li as a link to sign in page -->
                    <?php
                    }
                    else{
                    ?>
                    <a href="signin.php" class="nav-link">
                        <div class="nav-box nav-box-signin">
                            <i class="fa-regular fa-user nav-box-signin-icon"></i>
                            <span class="nav-box-text nav-box-signin-text">
                                <?php echo $signin_txt; ?>
                            </span>
                        </div>
                    </a>
                    <?php
                    }
                    ?>

                    <!-- Make dropdown signout if logged in -->
                    <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']){?>
                        <ul id = "dropdown" class="dropdown">
                            <li>
                                <a href="orders.php">Orders</a>
                            </li>
                            <li>
                                <a href="signout.php">Sign out</a>
                            </li>
                        </ul>
                    <?php } ?>

                </li>
                <li>
                    <a href="cart.php" class="nav-link">
                        <div class="nav-box nav-box-cart">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <p class="nav-box-cart-text">SHOPPING CART</p>
                            <p class="quantity" id="qty">(<?php echo $_SESSION['qty'] ?>)</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End of nav section -->

<script>
/* When the user clicks on account button, 
toggle between hiding and showing the signout dropdown content */
function signin_droplist() {
  document.getElementById("dropdown").classList.toggle("dropdown_show");
}
</script>
