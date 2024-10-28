<?php
session_start();
include('connection.php');


if(!isset($_SESSION['Logged In'])){
    header('location:Login.php');
    exit;
}
if(isset($_GET['logout'])){
    if(isset($_SESSION['Logged In'])){
        unset($_SESSION['Logged In']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        header('location:Login.php');
        exit;
    }
}
if(isset($_POST['change_password'])){
    $password = $_POST['password'];
    $confirmPassword =$_POST['confirmpassword'];
    $user_email = $_SESSION['user_email'];

    if($password !== $confirmPassword){
        header('location: account.php?error=password dont match');
    }
    else if(strlen($password) < 6){
        header('location: account.php?error=password must be at least 6 characters');

        //no error
    }else{
        $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
        $stmt->bind_param('ss',md5($password),$user_email);

        if($stmt->execute()){
            header('location:account.php?message=password has been updated successfully');
        }else{
            header('location:account.php?message= could not update password');

        }
    }
}


//get orders 
if(isset($_SESSION['Logged In'])){
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id= ?");

    $stmt->bind_param('i',$user_id);
    $stmt->execute();

    $orders = $stmt->get_result();
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
            <a href="Cart.php"><i class="fas fa-solid fa-cart-shopping"></i><a>
             <a href="account.php"><i class="fas fa-solid fa-user"></i><a>
        
        </li>    
       
      </ul>
   
    </div>
  </div>
</nav>
        
        <!--Account Page -->
        <section class="=my-5 py-5">
            <div class="row container mx-auto">
                <div class="text-center mt-3 pt-5 col-lg col-md-12 col-sm-12">
                    <h3 class="font-weight-bold">Account Information</h3>
                    <?php if(isset($_GET['Register_success'])){echo $_GET['Register_success'];} ?>
                    <?php if(isset($_GET['login_message'])){echo $_GET['login_message'];} ?>
                    <hr class="mx-auto">
                    <div class="account-info">
                        <p>Name:<span> <?php if(isset($_SESSION['user_name'])) {echo $_SESSION['user_name'];} ?></span></p>
                        <p>Email:<span> <?php if(isset($_SESSION['user_email'])) {echo $_SESSION['user_email'];}; ?></span></p>
                        <p><a href="orders" id="order-btn">Your Orders</a></p>
                        <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
                        
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <form id="account-form" method="POST" action="account.php">
                        <?php if(isset($_GET['error'])){echo $_GET['error'];} ?>
                        <?php if(isset($_GET['message'])){echo $_GET['message'];} ?>
                        <h3>Change Password</h3>
                        <hr class="form-group">
                        <div class="form-group">
                            <label>Password</label>
                             <input type="password" class="form-control" id="account-password" name="password" placeholder="password" required />
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                             <input type="password" class="form-control" id="account-password-confirm" name="confirmpassword" placeholder="password" required />
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Change Password" name="change_password" class="change-pass-btn" id="change-password">
                               </div>
                    </form>
                </div>
            </div>
        </section>
        
        
<!--Order-->
 <Section id="orders" class="order container my-5 py-3">
            <div class="container mt-2">
                <h2 class="font-weight-bold text-center">Your Orders</h2>
                <hr class="mx-auto">
            </div>

            <table class="mt-5 pt-5">
                <tr>
                    <th>Order ID</th>
                    <th>Order Costs</th>
                    <th>Order Status</th>
                    <th>Order Date</th>
                    <th>Order Details</th>
                </tr>
                

                <?php while($row = $orders->fetch_assoc()){ ?>

                    <tr>
                    <td>
        <span><?php echo $row['order_id']; ?></span>
    </td> 
    <td>
        <span><?php echo $row['order_cost']; ?></span>
    </td> 

    <td>
        <span><?php echo $row['order_status']; ?></span>
    </td>

    <td>
        <span><?php echo $row['order_date']; ?></span>
    </td>

    <td>
    <form method="POST" action="order_details.php">
    <input type="hidden" value="<?php echo $row['order_id'];?>" name="order_id"/>
    <input class="btn order-details-btn" name="order_details_btn" type="submit" value="Details"/>
</form>
    </td>
</tr>
               <?php } ?>
                
            </table>
            
            
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