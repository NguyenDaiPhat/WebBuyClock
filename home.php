<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id']??0;

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];
   $product_brand = $_POST['product_brand'];
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image, brand) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image', '$product_brand')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">
   
</head>
<body>
<?php include 'header.php'; ?>


<section class="home">

   <div class="content">
      <h3>A REPUTABLE PLACE TO BUY MECHANICAL WATCHES IN HANOI</h3>
      <p>Mechanical watches have always been the first choice of gentlemen from the past to now. 
         They have become a hobby and a passion for many people. 
         However, in the face of the real and fake watch market, consumers need a place to put their trust and money.</p>
      <a href="about.php" class="white-btn">discover more</a>
   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>
   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM products LIMIT 9") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?> 
     <form action="" method="post" class="box">
     <input type="hidden" name="product_brand" value="<?php echo $fetch_products['brand']; ?>">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">$<?php echo $fetch_products['price']; ?></div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <!-- them ben nhap vao khi co san pham -->

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      <a href="trademark.php" class="option-btn">load more</a>
   </div>

</section>


<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p>Surely those who love mechanical watches know that they are not cheap because of their complicated design 
            and many different components. In fact, there are still many cheap automatic mechanical watch collections 
            from a few brands such as Orient, Citizen, Seiko, etc., which are worth buying. Table of Contents 
             Advantages of watches…</p>
         <a href="about.php" class="btn">read more</a>
      </div>

   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>Q&A ABOUT WATCHES</h3>
      <p>When choosing to buy a product or in the process of using a watch, 
         you will surely encounter a lot of questions without knowing who and 
         which unit will support...</p>
      <a href="contact.php" class="white-btn">contact us</a>
   </div>

</section>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>