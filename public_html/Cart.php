<?php 
 
 session_start();

 
 
 if(isset($_POST['add_to_cart'])){

    //if user  has already added a product in the cart
    if(isset($_SESSION['cart'])){
        $product_array_ids = array_column($_SESSION['cart'],"product_id");

        //if product has alreaady been added to the cart or not 
    if(!in_array($_POST['product_id'] , $product_array_ids)){



         $product_id = $_POST['product_id'];
         $product_name = $_POST['product_name'];
         $product_price = $_POST['product_price'];
         $product_image = $_POST['product_image'];
         $product_quantity = $_POST['product_quantity'];
      
     $product_array = array(
        'product_id'=> $product_id,
        'product_name'=> $product_name,
        'product_price'=> $product_price,
        'product_image'=> $product_image,
        'product_quantity'=> $product_quantity

            
            );
      
            $_SESSION['cart'][$product_id] = $product_array;
              
        }else{
            echo '<script>alert("Product was already added to the cart");</script>';
            
        } 

    }else{
      $product_id = $_POST['product_id'];
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = $_POST['product_quantity'];
      
      $product_array = array(
        'product_id'=> $product_id,
        'product_name'=> $product_name,
        'product_price'=> $product_price,
        'product_image'=> $product_image,
        'product_quantity'=> $product_quantity
      );

      $_SESSION['cart'][$product_id] = $product_array;
       

    }
      calculateTotalCart();

    //remove product from cart
 }else if(isset($_POST['remove_product'])){

    $product_id = $_POST['product_id'];
    unset(($_SESSION)['cart'][$product_id]);

    calculateTotalCart();


    //edit quantity
}else if(isset($_POST['edit_quantity'])){

    //we get id and quantity from the 
    $product_id = $_POST['product_id'];
    $product_quantity = $_POST['product_quantity'];

    //get the product array from the session
    $product_array = $_SESSION['cart'][$product_id];

    //update product quantity
    $product_array['product_quantity'] = $product_quantity;

    //return array back to its place
    $_SESSION['cart'][$product_id] = $product_array;

    calculateTotalCart();


}
 

 
 else{
  //  header('location:index.php');
 }

 function calculateTotalCart(){

    $total= 0 ;
    $total_quantity = 0;

    foreach ($_SESSION['cart'] as $key => $value) {
        
        $product = $_SESSION['cart'][$key];


        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ($price * $quantity);
        $total_quantity = $total_quantity + $quantity;

        
    }

    $_SESSION['total'] = $total;
    $_SESSION['qauntity'] = $total_quantity;
 }
 

?>




<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Other/html.html to edit this template
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css"/>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
   
    </head>
    <body>
         <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
  <div class="container">
      <img class="logo" src="Logo1.jpg" alt=""/>
      <h2 class="brand">Boys Of Soweto</h2>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
       
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        
         <li class="nav-item">
          <a class="nav-link" href="shop.php">Shop</a>
        </li>
        
         <li class="nav-item">
          <a class="nav-link" href="contact.html">Contact Us</a>
        </li>
        
        <li class="nav-item">
            <a href="Cart.php">
            <i class="fas fa-solid fa-cart-shopping">
                <?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] !=0) {?>
                    <span> <?php echo $_SESSION['quantity'] ;?> </span>
                <?php } ?>

            </i>
                </a>
             <a href="account.php"><i class="fas fa-solid fa-user"></i><a>
        
        </li>    
       
      </ul>
   
    </div>
  </div>
</nav>
        
        <!--Cart-->
        <Section class="cart container my-5 pt-5">
            <div class="container mt-5">
                <h2 class="font-weight-bolde">Your Cart</h2>
                <hr>
            </div>
            <table class="mt-5 pt-5">
                <tr> 
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>SubTotal</th>
                </tr>


                <?php if(isset($_SESSION['cart'])){?>


                


                
                <?php  foreach($_SESSION['cart'] as $key => $value){ ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="<?php  echo $value ['product_image'];?>" />
                            <div>
                                <p><?php  echo $value ['product_name'];?></p>
                                <small><span>R</span><?php echo $value['product_price']; ?></small>
                                <br>
                             <form method="POST" action="Cart.php">
                                  <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                                   <input type="submit" name="remove_product" class="remove-btn" value="remove"/>
                            </form>
                               
                            </div>
                        </div>
                    </td>
                    <td>
                        
                        <form method="POST" action="Cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>"/>
                            <input type="number" name="product_quantity" value="<?php echo $value['product_quantity']; ?>"/>
                            <input type="submit" class="edit-btn" value="edit" name="edit_quantity" />
                         </form>
                       
                    </td>
                    
                    <td>
                        <span>R</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>
                <?php } ?>

                <?php } ?>
                
            </table>
            
            <div class="cart-total">
            <table>
               <!-- <tr>
                    <td>Subtotal</td>
                    <td>R4500</td>
                    
                </tr> -->
                    <tr>
                        <td>Total</td>
                        <?php if(isset($_SESSION['cart'])){?>
                        <td>R<?php echo $_SESSION ['total'];?></td>
                        <?php } ?>
                    </tr>
            </table>
            </div>
            
            <div class="checkout-container">

            <form method="POST" action="checkout.php">
              <input type="submit"  class="btn checkout-btn" value="Checkout" name="checkout"/>
            </form>
               

            </div>
        </section>
               
        
        
          <footer class="mt-5 py-5">
              <div class="row container mx-auto pt-5">
                  <div class="footer onecol-lg-3 col-md-6 col-sm-12">                      
                      <img class="logo" src="Logo1.jpg" alt=""/>
                      <p class="pt-3">We provide the best products for the most affordable prices></p>
                  </div>
                   <div class="footer onecol-lg-3 col-md-6 col-sm-12">                      
                       <h5 class="pb-2">Featured</h5>
                       <ul class="text-uppercase">
                           <li><a href="#">Men</a></li>
                           <li><a href="#">Women</a></li>
                           <li><a href="#">Men</a></li>
                           <li><a href="#">Boys</a></li>
                           <li><a href="#">Girls</a></li>
                           <li><a href="#">New Arrival</a></li>
                           
                       </ul>
                  </div>
                   <div class="footer onecol-lg-3 col-md-6 col-sm-12">                      
                       <h5 class="pb-2">Contact Us</h5>
                       <div>
                           <h6 class="text-uppercase">Address</h6>
                           <p> 99 Juta St , Braamfontein , Johannesburg , 2001</p>
                       </div>
                       <div>
                           <h6 class="text-uppercase">Tel /Phone</h6>
                            <p>074 935 5220</p>
                       </div>
                        <div>
                           <h6 class="text-uppercase">Email</h6>
                            <p>Boysofsoweto@Gmail.com</p>
                       </div>
                        <div class="footer onecol-lg-3 col-md-6 col-sm-12">                      
                            <h5 class="pb-2">Instagram</h5>
                            <div class="row">
                                <img src="IMG_F1.jpg"class="img-fluid w-25 h-100 m-2"/>
                                 <img src="IMG_F2.jpg"class="img-fluid w-25 h-100 m-2"/>
                                  <img src="IMG_F3.jpg"class="img-fluid w-25 h-100 m-2"/>
                                   <img src="IMG_F4.jpg"class="img-fluid w-25 h-100 m-2"/>
                            </div>
                  </div>
              </div>
                  <div class="copyright mt-5">
                      <div class="row-container mx-auto">
                          <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                              <img src="Pay1.jpg"/>
                          </div>
                          <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-2">
                              <p>eCommerce @2024 All Rights Reserved</p>
                          </div>
                            <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
                                <a href="#"><i class="fab fa-facebook"></i><a/>
                                <a href="#"><i class="fab fa-instagram"></i><a/>
                                <a href="#"><i class="fab fa-twitter"></i><a/>
                          </div>
                      </div>
                      
                  </div>
          </footer>
        <script src="https://kit.fontawesome.com/65e6ef9c8c.js" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 
    </body>
</html>
