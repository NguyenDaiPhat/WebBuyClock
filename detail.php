<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id']??0;

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $check_product= mysqli_query($conn, "select*from products where id= '$id'") or die('query failed');
  if(mysqli_num_rows($check_product) > 0){
    while($fetch_product = mysqli_fetch_assoc($check_product)){
    $name = mysqli_real_escape_string($conn, $fetch_product['name']);
    $price = $fetch_product['price'];
    $image = mysqli_real_escape_string($conn, $fetch_product['image']);
    $detail = mysqli_real_escape_string($conn, $fetch_product['detail']);
    $brand = mysqli_real_escape_string($conn, $fetch_product['brand']);
    }
}
}
// $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE id = '$id' AND user_id = '$user_id'") or die('query failed');
//    var_dump(mysqli_num_rows($check_cart_numbers));

if(isset($_POST['add_to_cart'])){
  $quantity=$_POST['quantity'];
   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$name' AND user_id = '$user_id'") or die('query failed');
   
   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image, brand) VALUES('$user_id', '$name', '$price', '$quantity', '$image', '$brand')") or die('query gfailed');
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
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/detail.css">
   <link rel="stylesheet" href="css/style.css">
   <!-- <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet"> -->

   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> 
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
</head>
<body>
   
<?php include 'header.php'; ?>
<div class="heading">
   <h3>Product Detail</h3>
</div>

  <div class="pd-wrap">
    <div class="container">
          
          <div class="row">
            <div class="col-md-6">
            <div class="item">
                <img width=450px height=280px src="uploaded_img/<?php echo $image ?>">
            </div>
            </div>
            <div class="col-md-6">
              <div class="product-dtl">
                <div class="product-info">
                  <div class="product-name"><?php echo $name ?></div>
                  <div class="reviews-counter">
                <span>by</span>
                <span><?php echo $brand ?></span>
              </div>
                  <div class="product-price-discount">$<span><?php echo $price ?></span></div>
                </div>
                <p><?php echo $detail ?></p>
               
                <div class="product-count">
                  <label for="size"><span class="cc">Quantity</span></label>
                  <form action="#" class="display-flex" method="POST">
                  <div class="qtyminus">-</div>
                  <div><input type="text" name="quantity" value="1" class="qty"></div>
                  <div class="qtyplus">+</div>
                  <button  class="round-black-btn" name='add_to_cart'>Add to Cart</button>
              </form>
                </div>
              </div>
            </div>
          </div>
          <div class="product-info-tabs">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews (0)</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.
            </div>
            <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
              <div class="review-heading">REVIEWS</div>
              <p class="mb-20">There are no reviews yet.</p>
              <form class="review-form">
                  <div class="form-group">
                    <label>Your rating</label>
                    <div class="reviews-counter">
                  <div class="rate">
                      <input type="radio" id="star5" name="rate" value="5" />
                      <label for="star5" title="text">5 stars</label>
                      <input type="radio" id="star4" name="rate" value="4" />
                      <label for="star4" title="text">4 stars</label>
                      <input type="radio" id="star3" name="rate" value="3" />
                      <label for="star3" title="text">3 stars</label>
                      <input type="radio" id="star2" name="rate" value="2" />
                      <label for="star2" title="text">2 stars</label>
                      <input type="radio" id="star1" name="rate" value="1" />
                      <label for="star1" title="text">1 star</label>
                  </div>
                </div>
              </div>
                  <div class="form-group">
                    <label>Your message</label>
                    <textarea class="form-control" rows="10"></textarea>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="" class="form-control" placeholder="Name*">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input type="text" name="" class="form-control" placeholder="Email Id*">
                      </div>
                    </div>
                  </div>
                  <button class="round-black-btn">Submit Review</button>
                </form>
            </div>
        </div>
      </div>
      
      
    </div>
  </div>

<script src="js/script.js"></script>
<script src="js/detail.js"></script>
<?php include 'footer.php'; ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="	sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>