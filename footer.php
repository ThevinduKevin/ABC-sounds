<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>
    
<!-- bottom nav---------------------------------------- -->
   
<nav class="bottom-navbar">

 

<a href="home_page.php" class="fa-solid fa-house"></a>
 
<a href="#home_page.php#arrivals" class="fa-solid fa-tag"></a>
 
<?php

if(isset($_SESSION['user_id'])){
        $choose=mysqli_query($conn,"SELECT *FROM users WHERE user_id='$id'");
        $row=mysqli_fetch_assoc($choose);

        $u=$row['email'];
        $p= $row['upassword'];

        $take=mysqli_query($conn,"SELECT *FROM admins WHERE email='$u' and apassword='$p'");
        if(mysqli_num_rows($take)>0){
            echo'<a href="admin.php" class="fas fa-user-shield"></a>';  
    
        } 
                   
    }
        ?>

</nav>

    
    

     <!--footer -->
<section class="footer">

<div class="box-container">

    <div class="box">
        <h3>Our Location</h3>
        <a href="#" ><i class="fa-solid fa-location-dot"></i>Maharagama</a>  
    </div>

    <div class="box">
        <h3>Paths</h3>
        <a href="home_page.php"><i class="fa-solid fa-arrow-right"></i>Home</a>
        <a href="home_page.php#arrivals"><i class="fa-solid fa-arrow-right"></i>Arrivals</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Account info</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Privacy Policy</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Our Services</a> 
        
    </div>

    <div class="box">
        <h3>Contact Info</h3>
         
        <a href="#"><i class="fa-solid fa-phone"></i>0703463598</a>
        <a href="#"><i class="fa-solid fa-envelope"></i>supadmin@gmail.com</a>
    </div>

</div>
<div class="share">
    <a href="#" class="fa-brands fa-facebook"></a>
    <a href="#" class="fa-brands fa-whatsapp"></a>
    <a href="#" class="fa-brands fa-linkedin"></a>
    <a href="#" class="fa-brands fa-instagram"></a>
</div>
<div class="credit_back">
    <div class="credit">© All Rights Reserved By ABC Sounds</div>
</div>

</section>
<!-- footer section ends -->


</body>
</html>