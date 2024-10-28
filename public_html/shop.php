<?php 
include('connection.php');


$stmt = $conn->prepare("SELECT * FROM products" );

$stmt->execute();

$products = $stmt->get_result();


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
        <style>
            .product img {
                width:100%;
                height:auto;
                box-sizing: border-box;
                object-fit: cover;
            }
            .pagniation a{
                color:black;
            }
            .pagniation li:hover a{
                color:#fff;
                background-color: black;
                font-weight: bold !important;
            }

        </style>
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
           <!--Shop--> 
         <section id="shop" class="my-5 py-5">
             <div class="container text-center mt-5 py-5"> 
                 <h3> Beanies , Shirts & Jerseys</h3>
                 <hr>
                 <p>Here you can check amazing pieces</p>
             </div>
             <div class="row mx-auto container-fluid">

             <?php while($row = $products->fetch_assoc()) { ?>

                 <div onclick=" "  class="product text-center col-lg-3 col-md-4 col-sm-12">
                  <img class="img-fluid mb-3 " src="<?php echo $row['product_image'] ;?>"/>
                 <h5 class="p-name"><?php echo $row['product_name'] ;?></h5>
                 <h4 class="p-price"><?php echo $row['product_price'] ;?></h4>
                 <button class="buy-btn"><a href="<?php echo "single_product.php?product_id=".$row['product_id']; ?>">Buy Now</a></button>
                 </div>
                 <?php } ?>
             </div>            
             <br>
            
         </section>
        
        
        
        
        
         <!--Footer-->
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
