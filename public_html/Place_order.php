<?php

session_start();
include('connection.php');

//if user is logged in
if(!isset($_SESSION['Logged In'])){
    header('location:checkout.php?message=PLease login/register to place an order');
    exit;



}
//if user not logged in 
else{
    



if(isset($_POST['place_Order']) ){

//get user info and store it in database
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$address = $_POST['address'];

$order_cost = $_SESSION['total'];
$order_status ="on_hold";
$user_id = $_SESSION['user_id'];
$order_date = date('Y-m-d H:i:s'); 

//store order info in database
$stmt = $conn->prepare("INSERT INTO orders(order_cost, order_status, user_id, user_phone, user_city, user_address, order_date)
                                VALUES (?, ?, ?, ?, ?, ?, ?)");


$stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);

$stmt_status = $stmt->execute();

if(!$stmt_status){
    header('location:index.php');
    exit;
}

//issue new order and store ordr info in database
$order_id = $stmt->insert_id;


echo $order_id;




//get products from cart
foreach($_SESSION['cart'] as $key => $value){
    $product = $_SESSION['cart'] [$key];
    $product_id = $product['product_id'];
    $product_name = $product['product_name'];
    $product_image = $product['product_image'];
    $product_price = $product['product_price'];
    $product_quantity = $product['product_quantity'];

    $stmt = $conn->prepare("INSERT INTO order_items(order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
                             VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param('iissiiis',$order_id,$product_id ,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);
     
    $stmt->execute();


}

//remove everything from cart -- delay until user can make payment
//unset($_SESSION['Cart']);



//inform user whether everything is fine or there is a problem 
header('location: payment.php?order_status=order placed successfully');





}
}
