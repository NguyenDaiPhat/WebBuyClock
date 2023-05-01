<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? 0;



if (isset($_POST['update_cart'])) {
   $cart_id = $_POST['cart_id'];
   $cart_quantity = $_POST['cart_quantity'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
   $message[] = 'cart quantity updated!';
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
   header('location:cart.php');
}
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:cart.php');
}

?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- bootstrap5 link -->
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
   <style>
      .btn:hover {
         background-color: var(--light);

      }

      .btns {
         padding-bottom: 2rem;
         cursor: pointer;
         color: var(--white);
         font-size: 1.8rem;
         border-radius: .5rem;
         text-transform: capitalize;
      }

      .btns:hover {
         text-decoration: none;
         color: black;
      }

      /* .header{
         height:px;
      } */
   </style>
</head>

<body>



   <div class="heading">
      <h3>Cart</h3>
   </div>
   <div>&nbsp;</div>
   <div>&nbsp;</div>

   <?php
   $grand_total = 0;
   $select_cart = mysqli_query($conn, "SELECT b.id, user_id, a.name, a.price, a.quantity, a.image, b.brand, a.id 'id_cart' from cart a join products b where a.name = b.name and user_id = '$user_id'") or die('query failed');
   if (mysqli_num_rows($select_cart) > 0) {
   ?>
      <div class="">
         <div class="row">
            <div id="table" class="col-sm-12 col-md-10 col-md-offset-1">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                     ?>
                        <tr>
                           <td class="col-sm-8 col-md-6">
                              <div class="media">
                                 <a class="thumbnail pull-left" href="detail.php?id=<?php echo $fetch_cart['id'] ?>"> <img class="media-object" src="uploaded_img/<?php echo $fetch_cart['image']; ?>" style="width: 72px; height: 72px;"> </a>
                                 <div class="media-body">
                                    <h4 class="media-heading"><a href="detail.php?id=<?php echo $fetch_cart['id'] ?>"><?php echo $fetch_cart['name']; ?></a></h4>
                                    <h5 class="media-heading"> by <a href=""><?php echo $fetch_cart['brand'] ?></a></h5>
                                 </div>
                              </div>
                           </td>
                           <form action="" method="post">
                              <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id_cart']; ?>">
                              <td class="col-sm-1 col-md-1 " style="text-align: center">
                                 <input type="number" min="1" name="cart_quantity" class="form-control " id="exampleInputEmail1" value="<?php echo $fetch_cart['quantity']; ?>">
                              </td>
                              <td class="col-sm-1 col-md-1 text-center "><strong>$<?php echo $fetch_cart['price']; ?></strong></td>
                              <td class="col-sm-1 col-md-1 text-center"><strong>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?></strong></td>
                              <td class="" data-th="">
                                 <div class="text-right">
                                    <button name="update_cart" class=" ">
                                       <i class="fas fa-sync"></i>
                                    </button>

                           </form>
                           <a href="cart.php?delete=<?php echo $fetch_cart['id_cart']; ?>" class="fas fa-trash" onclick="return confirm('Delete this from cart?');"></a>
            </div>
            </td>
            </tr>
            </tbody>
         <?php
                        $grand_total += $sub_total;
                     }

         ?>
         <div style="margin-top: 2rem; text-align:center;">
            <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all</a>
         </div>
         <footer>
            <tr>
               <td> </td>
               <td> </td>
               <td> </td>
               <td>
                  <h3>Grand Total</h3>
               </td>
               <td class="text-right ">
                  <h3><strong><?php echo $grand_total; ?>$ </strong></h3>
               </td>
            </tr>
            <tr>
               <td> </td>
               <td> </td>
               <td> </td>
               <td>

                  <button type="button" class="btn btn-default">
                     <span class="glyphicon glyphicon-shopping-cart"><a href="trademark.php" class="btns">continue shopping</a></span>
                  </button>
               </td>
               <td>

                  <button type="button" class="btn btn-success">
                     <a href="checkout.php" class="btns <?php echo ($grand_total > 0) ? '' : 'disabled'; ?>">Checkout</a> <span class="glyphicon glyphicon-play"></span>
               </td>

            </tr>
         </footer>
         </table>
      <?php
   } else {
      echo '<p class="empty">Your cart is empty</p>';
   }
      ?>
         </div>
      </div>
      </div>


      <div>&nbsp;</div>


      <?php include 'footer.php'; ?>

      <!-- custom js file link  -->
      <script src="js/script.js"></script>

</body>

</html>