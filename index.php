<?php
session_start();

// Connecting to database to get the products
$link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index-style.css">
    <!--adding font awesome icons library-->
    <script src="https://kit.fontawesome.com/28cbcae3e4.js" crossorigin="anonymous"></script>
    <title>Nespresso</title>
</head>

<body>
    <!--Navbar Section-->
    <?php include('header.php'); ?>


    <!--Hero Section-->
    <section class="hero">
        <div class="hero-div">
            <div class="hero-text">
                <p class="p1">SUMMER SALE</p>
                <p class="p2">VERTUO NOW £69</p>​
                <p class="p3">RRP £99</p>
                <p class="p3">50 FREE CAPSULES</p>
                <p class="p3">AND £45 OFF COFFEE WHEN YOU SIGN UP</p>
                <a href=""><button>Discover More</button></a>
            </div>
            <div class="hero-img">
                <img src="images/sale.png" alt="">
            </div>
        </div>
    </section>


    
    <!--Capsules Section-->
    <section class="capsules-sec">
        <div class="capsules-div">
            <h2>Capsules</h2>
            <div class="capsules-grid">
                <?php
                // Getting products with category 0
                $products = mysqli_query($link,"SELECT * FROM product where cat=0 limit 8");
                for($x=0;$x<8;$x++){
                    // Fetching every product
                    $row = mysqli_fetch_assoc($products);
                    $id = $row['id'];
                ?>
                    <div class="capsule">
                        <div class="capsule-up">
                            <a href="product.php?id=<?php echo $row['id']?>">
                                    <img src="images/<?php echo $row['image'] ?>" alt="">
                                    <p class="capsule-name"><?php echo $row['name'] ?></p>
                            </a>
                        </div>
                        <div class="capsule-bottom">
                            <p class="price">£<?php echo $row['price'] ?></p>
                            <form method="post">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="id" value= "<?php echo $id?>"></input>
                                <button type="button" id="<?php echo $id?>" class="add" 
                                    onclick="addProduct(this.id)">+</button>
                            </form>
                        </div>
                    </div>
                <?php 
                } 
                ?>
            </div>
            <a href="showmore.php?id=<?php echo $row['cat']?>">
                <button class="show-more-btn">Show more</button>
            </a>
        </div>
    </section>

    <!--Accessories Section-->
    <section class="capsules-sec">
        <div class="capsules-div">
            <h2>Accessories</h2>
            <div class="capsules-grid">
                <?php
                // Getting products with category 1
                $products = mysqli_query($link,"SELECT * FROM product where cat=1 limit 8");
                for($x=0;$x<8;$x++){
                    // Fetching every product
                    $row = mysqli_fetch_assoc($products);
                    $id = $row['id'];
                ?>
                    <div class="capsule">
                        <div class="capsule-up">
                            <a href="product.php?id=<?php echo $row['id']?>">
                                    <img src="images/<?php echo $row['image'] ?>" alt="">
                                    <p class="capsule-name"><?php echo $row['name'] ?></p>
                            </a>
                        </div>
                        <div class="capsule-bottom">
                            <p class="price">£<?php echo $row['price'] ?></p>
                            <form method="post">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="id" value= "<?php echo $id?>"></input>
                                <button type="button" id="<?php echo $id?>" class="add" 
                                    onclick="addProduct(this.id)">+</button>
                            </form>
                        </div>
                    </div>
                <?php 
                } 
                ?>
            </div>
            <a href="showmore.php?id=<?php echo $row['cat']?>">
                <button class="show-more-btn">Show more</button>
            </a>
        </div>
    </section>

    <!--Coffee Machines Section-->
    <section class="capsules-sec">
    <div class="capsules-div">
            <h2>Coffee Machines</h2>
            <div class="capsules-grid">
                <?php
                // Getting products with category 2
                $products = mysqli_query($link,"SELECT * FROM product where cat=2 limit 8");
                for($x=0;$x<8;$x++){
                    // Fetching every product
                    $row = mysqli_fetch_assoc($products);
                    $id = $row['id'];
                ?>
                    <div class="capsule">
                        <div class="capsule-up">
                            <a href="product.php?id=<?php echo $row['id']?>">
                                    <img src="images/<?php echo $row['image'] ?>" alt="">
                                    <p class="capsule-name"><?php echo $row['name'] ?></p>
                            </a>
                        </div>
                        <div class="capsule-bottom">
                            <p class="price">£<?php echo $row['price'] ?></p>
                            <form method="post">
                                <input type="hidden" name="qty" value="1">
                                <input type="hidden" name="id" value= "<?php echo $id?>"></input>
                                <button type="button" id="<?php echo $id?>" class="add" 
                                    onclick="addProduct(this.id)">+</button>
                            </form>
                        </div>
                    </div>
                <?php 
                } 
                ?>
            </div>
            <a href="showmore.php?id=<?php echo $row['cat']?>">
                <button class="show-more-btn">Show more</button>
            </a>
        </div>
    </section>

    <!--Footer-->
    <footer>
        <div class="footer-div">
            <a href="">About us</a>
            <p>|</p>
            <a href="">Contact us</a>
            <p>|</p>
            <a href="">FAQs</a>
        </div>
    </footer>
</body>
</html>


<script>
   
    function addProduct(buttonId){

        // handle clicking the form button by sending request to the server
        req = new XMLHttpRequest();
        req.open("POST","productadd.php",true);
        req.onreadystatechange = updateQty;

        // Create a form object to send
        addForm = document.getElementById(buttonId).parentElement;
        formData = new FormData(addForm);

        // Send form
        req.send(formData);
    }

    // Update cart quantity number in the page
    function updateQty(){
        var qtyNum = document.getElementById("qty");
        qtyNum.innerHTML = req.responseText;

    }

</script>