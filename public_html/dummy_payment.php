<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Gateway</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
    body {
            background-color: #f4f7fa;
            font-family: 'Poppins', sans-serif;
        }
        .payment-form {
            max-width: 450px;
            margin: 50px auto;
            padding: 30px;
            background-color:#f4f7fa;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }
        .payment-form h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: 600;
            text-align: center;
        }
        .payment-form .form-control {
            border-radius: 8px;
            border: 1px solid #d1d1d1;
        }
        .payment-form .form-label {
            font-weight: 500;
            color: #555;
        }
        .payment-form .btn-primary {
            width: 100%;
            padding: 10px;
            font-weight: bold;
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 8px;
        }
        .payment-form .btn-primary:hover {
            background-color: #0056b3;
        }
        .card-icon {
            font-size: 2rem;
            color: #007bff;
            display: block;
            text-align: center;
            margin-bottom: 15px;
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
                    <span><?php echo $_SESSION['quantity'] ;?></span>
                <?php } ?>

            </i>
        </a>
        <a href="account.php"><i class="fas fa-solid fa-user"></i><a>
        
        </li>    
       
      </ul>
   
    </div>
  </div>
</nav>
    <div class="container mt-5">
    <span class="card-icon">💳</span>
        <h2>Payment Gateway</h2>   

        <form action="process_dummy_payment.php" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
            <label for="cardNumber" class="form-label">Card Number</label>
            <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="xxxx-xxxx-xxxx-xxxx" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="expiryDate" class="form-label">Expiry Date</label>
                <input type="text" class="form-control" id="expiryDate" name="expiry_date" placeholder="MM/YY" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="cvv" class="form-label">CVV</label>
                <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
            </div>
            <p>Order Total: R<?php echo isset($_SESSION['total']) ? $_SESSION['total'] : '0.00'; ?></p>
        </div>
       <a href="#" onclick="alert('Payment Successful'); return false;" class="btn btn-primary" role="button">Submit Payment</a>
        
    </form>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/65e6ef9c8c.js" crossorigin="anonymous"></script>
       <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 

</body>
</html>
