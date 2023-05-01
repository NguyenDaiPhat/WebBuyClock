<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">
   <div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Alberto.</a>

         <nav class="navbar">
            <a href="home.php">HOME</a>
            <a href="trademark.php">TRADEMARK</a>
            <a href="about.php">ABOUT</a>
            <a href="contact.php">CONTACT</a>
            <a href="orders.php">ORDERS</a>
         </nav>

         <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
               $select_cart_number = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
               $cart_rows_number = mysqli_num_rows($select_cart_number); 
            ?>
            <a href="cart.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         </div>

         <div class="user-box">
            <p>Username : <span><?php $user_name = $_SESSION['user_name']?? '';  echo $user_name; ?></span></p>
            <p>Email : <span><?php $user_email = $_SESSION['user_email']?? '';  echo $user_email; ?></span></p>
            <?php 
               if(!isset($_SESSION['user_name'])){
            ?>
               <a href="login.php" class="delete-btn">Login</a>
            <?php
               }else {
            ?>
            <a href="logout.php" class="delete-btn">Logout</a>
            <?php
               }
            ?>
            <a href="register.php" class="delete-btn">Register</a>
            
         </div>
      </div>
   </div>

</header>