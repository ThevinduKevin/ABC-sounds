<?php 
     include 'config.php';
     session_start();


     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];
     }

     if(isset($_SESSION['user_id'])){
        $choose=mysqli_query($conn,"SELECT *FROM users WHERE user_id='$id'");
        $row=mysqli_fetch_assoc($choose);

        $u=$row['email'];
        $p= $row['upassword'];

        $take=mysqli_query($conn,"SELECT *FROM admins WHERE email='$u' and apassword='$p'");
        if(!mysqli_num_rows($take)>0){
            header('Location:home_page.php');
    
        }     
                   
    }
    else{
        header('Location:home_page.php');
    }



    if(isset($_POST['submit'])){

        $product=$_POST['name'];
        $quantity=$_POST['quantity'];
        $descript=$_POST['description'];
        $price=$_POST['price'];
        
        $p_image = $_FILES['p_image']['name'];
        $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
       
        $p_image_folder_store = 'items/'.$p_image;//image that upload the name to the database will upload to this file
        

        $check=mysqli_query($conn,"SELECT *FROM products WHERE prod_name='$product'");

        if(mysqli_num_rows($check)>0){
            $row=mysqli_fetch_assoc($check);
            $quantity=$quantity+$row['quantity'];
            $pid=$row['product_id'];
          
            $add=mysqli_query($conn,"UPDATE products SET  quantity='$quantity',prod_description='$descript',price='$price',prod_img='$p_image' WHERE product_id='$pid'");
            if($add){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_store);
                    $message[]='Product Add Successfully';
            }
            else{
                $message[]='Product Not Updated';
            }

           
        }
        else{

        

        $insert=mysqli_query($conn,"INSERT INTO products(prod_name,quantity,prod_description,price,prod_img)
           VALUES('$product','$quantity','$descript','$price','$p_image')") or die('query failed');//insert the details of product(not the image, just the name of the image)

           if($insert){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_store);
                    $message[]='Product Add Successfully';

                
            }
            else{
                $message[]='Image Not Uploaded';
            }
        } 
         
    }

     
    //  update 

       if(isset($_POST['update_product'])){

         $update_id = $_SESSION['upid'];
        

         $update_p_name = $_POST['update_p_name'];
         $update_p_quantity = $_POST['update_p_quantity'];
         $update_p_description = $_POST['update_p_description'];

         $update_p_price = $_POST['update_p_price'];
         
         $update_p_image = $_FILES['update_p_image']['name'];
         $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
         
     
         $update_p_arrivals = 'items/'.$update_p_image;
         
         if($update_p_image){
            $update_query = mysqli_query($conn, "UPDATE products SET prod_name = '$update_p_name', quantity='$update_p_quantity', prod_description=' $update_p_description', price = '$update_p_price', prod_img = '$update_p_image' WHERE product_id = '$update_id'");

         }
         else{
            $update_querynopic = mysqli_query($conn, "UPDATE products SET prod_name = '$update_p_name', quantity='$update_p_quantity', prod_description=' $update_p_description', price = '$update_p_price' WHERE product_id = '$update_id'");

         }
         
         if($update_query){
        
                move_uploaded_file($update_p_image_tmp_name, $update_p_arrivals);
                $message[] = 'Product Add Successfully';
                header('location:admin.php');
         }
       }
       
         
     
     // rest
     if(isset($_GET['cancel'])){

        echo "<script>document.querySelector('.edit-form-container').style.display = 'none';</script>";
     }
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>

     <!-- linking fontawsome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="login_sign_style.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

    <style>
    
    
    .icon-eye {
        
        color: blue; /* Change the color to blue */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
    }
</style>
</head>
<body>
<header class="header">
<div class="header-1">
            <img src="logo3.jpg" height="60px" width="60px">
             
            <div class="icons">
                 
               
               <a href="login.php" id="login-btn"><i class="fa-solid fa-user"></i></a>
                 
            </div>
        </div>
         

        <div class="header-2">
            <nav class="navbar">
                <a href="home_page.php">Home</a>
                
                <a href="home_page.php#arrivals">Products</a>
                
                <a href="admin.php">Add Products</a>
                 
               
               
            </nav>
        </div>
    </header>

      <!-- add product -->
      <div class="product-container">
        <div id="" class="signdiv"></div>
        <form action="" method="POST" enctype="multipart/form-data">

            <h3>add product</h3>

            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>

      <div class="indiv">
      <span>product name</span>
            <input type="text" name="name" class="box" placeholder="name" id="" required>
            <span>quantity</span>
            <input type="number" name="quantity" class="box" placeholder="quantity" id="" required>
            <span>description</span>
            <input type="text" name="description" class="box" placeholder="description" id="" required>
           


      </div>

      <div class="indiv">
      <span>price</span>
            <input type="number" min="0" name="price" class="box" placeholder="price" id="" required>

      <span>image</span>     
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>       
            

      </div>

      <input type="submit" name="submit" value="Add" class="btn2" >
            
           
           
             
        </form>
    </div>
 


    
    
     <!-- product table -->
<section class="display-product-table" style="margin-bottom: 40px;">

<table>

   <thead>
      <th>image</th>
      <th>product</th>
      
      <th>quantity</th>
      <th>description</th>
      <th>price</th>
      <th>action</th>
   </thead>

   <tbody>
      <?php
      
          $select_products = mysqli_query($conn, "SELECT * FROM `products` ORDER BY product_id desc");
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
      ?>

      <tr>
        <?php 
        echo '<td><img src="items/'.$row['prod_img'].'" height="100" alt=""></td>';
        ?>
         
         <td><?php echo $row['prod_name']; ?></td>
         <td><?php echo $row['quantity']; ?></td>
         <td><?php echo $row['prod_description']; ?></td>
         <td>$<?php echo $row['price']; ?>/-</td>
         <td>
             <a href="admin.php?edit=<?php echo $row['product_id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
         </td>
      </tr>

      <?php
         };    
         }
         else{
            echo "<div class='empty'>no product added</div>";
         };
      ?>
   </tbody>
</table>

</section>

<!-- edit form -->

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM products WHERE product_id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
        while( $fetch_edit = mysqli_fetch_assoc($edit_query)){
            
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      
   <?php  
   echo '<img src="items/'.$fetch_edit['prod_img'].'" height="100" alt="">';
   ?>
    
      
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['prod_name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_quantity" value="<?php echo $fetch_edit['quantity']; ?>">
      <input type="text" class="box" required name="update_p_description" value="<?php echo $fetch_edit['prod_description']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">

       
      
      <?php $_SESSION['upid']=$fetch_edit['product_id']; ?>  
      <input type="file" class="box"  name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
       
      <a href="admin.php?reset='reset'" class="btn">cancel</a>
   </form>

   <?php
            
         };
        };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

      
<?php  
// include 'footer.php'; for bottom nav
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
   <script src="js.js"></script>
    
</body>
</html>