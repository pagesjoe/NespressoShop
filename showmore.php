<?php
session_start();

// Connecting to database to show products
$link = mysqli_connect('localhost','id21232422_youssef','Yoyo-momo9','id21232422_nespresso');
$cat = $_GET['id'];
$products = mysqli_query($link,"SELECT * FROM product where cat=$cat");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="showmore-style.css">
    <!--adding font awesome icons library-->
    <script src="https://kit.fontawesome.com/28cbcae3e4.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <!-- Navbar Section -->
    <?php include('header.php'); ?>

    
    <!-- Products Section -->
    <section class="capsules-sec">
        <div class="capsules-div">
            <h2><?php switch ($cat){
                case 0: echo "Capsules"; break;
                case 1: echo "Accessories"; break;
                case 2: echo "Machines"; break;
                }?>
            </h2>
            <div class="capsules-grid">
                <?php
                while($row = mysqli_fetch_assoc($products)) {
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