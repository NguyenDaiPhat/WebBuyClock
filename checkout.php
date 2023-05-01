<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id']??0;

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $number = $_POST['number'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['method']);
   $country = mysqli_real_escape_string($conn, $_POST['country']);
   $city = mysqli_real_escape_string($conn, $_POST['city']);
   $district = mysqli_real_escape_string($conn, $_POST['district']);
   $detail_address = mysqli_real_escape_string($conn, $_POST['detail_address']);
   $commune = mysqli_real_escape_string($conn, $_POST['commune']);
   $address = mysqli_real_escape_string($conn, $_POST['detail_address'].', '. $_POST['commune'].', '. $_POST['district'].', '. $_POST['city'].', '. $_POST['country']);
   $placed_on = date('d-M-Y');

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode($cart_products,'<br>');

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'Your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, detail_address ,commune, district, city, country, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$detail_address', '$commune', '$district', '$city', '$country', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failedd');
         $message[] = 'order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
         header('location:orders.php');
      }
   }
   
   // $order_noid = mysqli_query($conn, "Update `orders` set name = '$name', number = '$number', email = '$email', method = '$method', detail_address = '$detail_address', commune = '$commune', district = '$district', city= '$city', country = '$country', address = '$address', total_products = '$total_products', total_price = '$total_price', placed_on = '$placed_on' where user_id ='$user_id')") or die('query failedd');
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>Checkout</h3>
</div>

<section class="display-order">

   <?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
   ?>
   <p> <?php echo $fetch_cart['name']; ?> <span>(<?php echo '$'.$fetch_cart['price'].'/'.' x '. $fetch_cart['quantity']; ?>)</span> </p>
   <?php
      }
   }else{
      echo '<p class="empty">Your cart is empty</p>';
   }
   ?>
   <div class="grand-total"> Grand total : <span>$<?php echo $grand_total; ?>/-</span> </div>

</section>
<?php
         $select_productss = mysqli_query($conn, "SELECT * FROM orders where user_id='$user_id' and user_id != 0 order by id desc") or die('query failed');
         if(mysqli_num_rows($select_productss) > 0){
            $fetch_productss = mysqli_fetch_assoc($select_productss);}
?>
<section class="checkout">

   <form action="" method="post">
      <h3>Place your order</h3>
      <div class="flex">
         <div class="inputBox">
            <input type="text" name="name" required placeholder="Name"
            value="<?php if(isset($fetch_productss['name']))echo $fetch_productss['name'] ?>">
         </div>
         <div class="inputBox">
            <input type="number" name="number" required placeholder="Phone Number"
            value="<?php echo $fetch_productss['number'] ?>">
         </div>
         <div class="inputBox">
            <input type="email" name="email" required placeholder="Email"
            value="<?php if(isset($fetch_productss['email'])) echo $fetch_productss['email'] ?>">
         </div>
         <div class="inputBox">
            <select name="method" required>
               <option hidden placeholder="" >Payment method</option>
               <option <?php if(isset($fetch_productss['method']) && ($fetch_productss['method']=='delivery')) echo 'Selected'?> value="delivery">Cash on delivery</option>
               <option <?php if(isset($fetch_productss['method']) && ($fetch_productss['method']=='card')) echo 'Selected'?> value="card">Credit card</option>
               <option <?php if(isset($fetch_productss['method']) && ($fetch_productss['method']=='paypal')) echo 'Selected'?> value="paypal">Paypal</option>
               <option <?php if(isset($fetch_productss['method']) && ($fetch_productss['method']=='paytm')) echo 'Selected'?> value="paytm">Paytm</option>
            </select>
         </div>
         <div class="inputBox">
            <input type="text" name="country" required placeholder="Country eg: Viet Nam" 
            value="<?php if(isset($fetch_productss['country']))echo $fetch_productss['country'] ?>">
         </div>
         <div class="inputBox">
            <input type="text" name="city" required placeholder="City eg: Nam Dinh"
            value="<?php if(isset($fetch_productss['city']))echo $fetch_productss['city'] ?>">
         </div>
         <div class="inputBox">
            <input type="text" name="district" required placeholder="District eg: Nam Truc"
            value="<?php if(isset($fetch_productss['district']))echo $fetch_productss['district'] ?>">
         </div>
         <div class="inputBox">
            <input type="text" name="commune" required placeholder="Commune eg: Nam Giang"
            value="<?php if(isset($fetch_productss['commune']))echo $fetch_productss['commune'] ?>">
         </div>
         <div class="inputBox">
            <input type="text" name="detail_address" required placeholder="Detail eg: 12 Dong Coi..."
            value="<?php if(isset($fetch_productss['detail_address']))echo $fetch_productss['detail_address'] ?>">
         </div>
      </div>
      <input type="submit" value="Order now" class="btn" name="order_btn">
   </form>

</section>









<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>