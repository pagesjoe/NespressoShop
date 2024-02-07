<?php
    session_start();

    // Getting product details from database
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');
    $query = mysqli_query($link,"SELECT * FROM product WHERE id=$id");
    $product = mysqli_fetch_assoc($query);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="product-style.css">
    <!--adding font awesome icons library-->
    <script src="https://kit.fontawesome.com/28cbcae3e4.js" crossorigin="anonymous"></script>
    <title>Nespresso</title>
</head>

<body>
    <!--Navbar Section-->
    <?php include 'header.php'; ?>

    <!--Product-->
    <section class="product-sec">
        <div class="product-div">
            <div class="product-img">
                <img src="images/<?php echo $product['image2'] ?>" alt="">
            </div>
            <div class="details">
                <h2><?php echo $product['name'] ?></h2>
                <p>
                <?php echo $product['details'] ?>
                </p>
                <p class="price">£<?php echo $product['price'] ?></p>
                <div class="addform">
                    <form method="post" id="addProductForm">
                        <input type="number" name="qty" value="1" class="qty">
                        <input type="hidden" name="id" value= "<?php echo $id?>"></input>
                        <button type="button" onclick="addProduct()" class="add">
                            +
                        </button>
                    </form>
                </div>
            </div>
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
   
    function addProduct(){

        // handle clicking the form button by sending request to the server
        req = new XMLHttpRequest();
        req.open("POST","productadd.php",true);
        req.onreadystatechange = updateQty;

        // Create a form object to send
        addForm = document.getElementById("addProductForm");
        formData = new FormData(addForm);
        console.log(formData);

        // Send form
        req.send(formData);
    }

    // Update cart quantity number in the page
    function updateQty(){
        var qtyNum = document.getElementById("qty");
        qtyNum.innerHTML = req.responseText;
        console.log("haloo");

    }

</script>