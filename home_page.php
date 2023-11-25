<?php 
     include 'config.php';
     session_start();


     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];

     }

     if(isset($_GET['logout'])){
        session_destroy();
     }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home page</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <style>
    .icon-heart {
        color: red; /* Change the color to red */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
        padding-right: 20px;
    }

    .icon-heart:hover,
    .icon-eye:hover{
        color:purple;
        font-size: 30px;
        
    }

    .icon-eye {
        color: blue; /* Change the color to blue */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
    }
</style>
</head>
<body>

  <!-- ------------------HEADER----------------------- -->

    <header class="header">
        <div class="header-1">
            <img src="logo3.jpg" height="60px" width="60px">
            <h1>ABC Sounds</h1>
            
        </div>

        <div class="header-2">
            <div class="navbar">
                <a href="home_page.php#home">Home</a>
                <a href="home_page.php#arrivals">Products</a>
                 
                 
            
                <?php
              //this show only to admins. give access to admin panel
              if(isset($_SESSION['user_id'])){
                $choose=mysqli_query($conn,"SELECT *FROM users WHERE user_id='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['email'];
                $p= $row['upassword'];

                $take=mysqli_query($conn,"SELECT *FROM admins WHERE email='$u' and apassword='$p'");
                if(mysqli_num_rows($take)>0){
                    echo '<a href="admin.php">Add Products</a>';  
            
                } 
                           
            }
                ?>

<?php

if(isset($_SESSION['user_id'])){//only show to superadmin. give access to add admins
                $choose=mysqli_query($conn,"SELECT *FROM users WHERE user_id='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['email'];
                $p= $row['upassword'];

                $take=mysqli_query($conn,"SELECT *FROM super_admin WHERE email='$u' and sup_password='$p'");
                if(mysqli_num_rows($take)>0){
                    echo '<a href="add_admin_form.php">Add Admins</a>';  
            
                } 
                           
            }
                ?>
                <div class="icons">
                 
                 <a href="login.php" id="login-btn"><i class="fa-solid fa-user">Acc.</i></a>
                </div>
             
                 
            </div>
        </div>
    </header>

     <!-- hero section -->

     <div class="hero-image">
  <div class="hero-text">
    <h1>Shop Online For<br> Headsets, Headphones<br> And Earphones </h1>
    <p style="font-size: 25px;">ABC Sounds For a Better Sound Experience</p> 
     <button style="background-color:black; border:solid; border-radius: 0px; font-weight: 300; width: 150px; font-size: 2rem;"><a href = "home_page.php#arrivals"> Shop Now</a></button>
    

   </div>
</div> 


</section>

<!-- Products -->

<?php 

echo '<section class="featured" id="arrivals">

<h1 class="heading"><span>-Available Items-</span></h1>

<div class="swipers featured-sliders" style="display:flex;">

<section class="gallery" id="gallery">

  <div class="box-container">
        <div class="search">    
            <form action="">
                <input type="text" placeholder="Search.." name="search">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div>';
$gal=mysqli_query($conn,"SELECT *FROM products");

if(mysqli_num_rows($gal)>0){
    while($set=mysqli_fetch_assoc($gal)){
     
        echo '
    <div class="box">
        <img src="items/'.$set['prod_img'].'" alt="">
        <div class="content">

                <div class="icons">';

        
                 echo'  
                 
                </div>

                <h3 style="font-family: cursive;">'.$set['prod_name'].'</h3><br>
                <h3 style="font-family: cursive;">'.$set['prod_description'].'</h3>
                <h2 style="font-family: cursive;">'.'Rs.'.$set['price'].'/-'.'</h2>';                
                
       echo ' </div>
    </div>
    ';
        
    }
}
echo '</div>
</section>
</div>
</section>';

?>

<!-- footer -->
 <?php  include 'footer.php'; ?>
<!-- footer section ends -->


<!-- loader -->

<div class="loader-container">
<img src="loader.gif" alt="">
</div> 

<!-- swiper linking -->
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

   <!-- linking the javascript -->
   <script src="javascript.js"></script>

</body>
</html>