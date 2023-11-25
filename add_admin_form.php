   
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


     //   admin_add_process

   if(isset($_POST['add_admin'])){

    $aname = mysqli_real_escape_string($conn, $_POST['aname']);
    $aemail = mysqli_real_escape_string($conn, $_POST['aemail']);
    $anum = mysqli_real_escape_string($conn, $_POST['anum']);
    $apass = mysqli_real_escape_string($conn, md5($_POST['apassword']));
    $acpass = mysqli_real_escape_string($conn, md5($_POST['acpassword']));

    if($apass!= $acpass){
       $messageA[]='confirm password not match';
    }
    else{
       $check_admin=mysqli_query($conn,"SELECT *FROM admins WHERE email='$aemail' and apassword='$apass'  ");

       if(mysqli_num_rows($check_admin)>0){
          $messageA[]='Admin Already Exist';
       }
       else{
          $add_am=mysqli_query($conn,"INSERT INTO `admins`(`name`, `email`, `phone_number`, `apassword`) VALUES ('$aname','$aemail','$anum','$apass')");
          $add_us=mysqli_query($conn,"INSERT INTO `users`(`user_name`, `email`, `user_number`, `upassword`) VALUES ('$aname','$aemail','$anum','$apass')");

          if($add_am and $add_us){
             $messageA[]='Admin Add Process Sucsessfully';
          }
          else{
             $messageA[]='Fail';
          }
       }
    }

   

 }

?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="login_sign_style.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>

   </head>
   <body>
         <!-- ----------admin add-------------- -->
                    <!-- sign form -->

    <?php   
    
       echo '<div class="add-form-container">
       <div id="" class="signdiv"></div>
       <form action="" method="POST" enctype="multipart/form-data">

       <a href="admin.php"  class="icon-eye fas fa-times"></a>
           <h3>Register Admin</h3>';

                 
      if(isset($messageA)){
         foreach($messageA as $messageA){
            echo '<div class="message">'.$messageA.'</div>';
         }
      }

         echo '
         
         <span>Name</span>
         <input type="text" name="aname" class="box" placeholder="User name" id="" required>
         <span>Email</span>
         <input type="email" name="aemail" class="box" placeholder="Enter your email" id="" required>
         <span>Mobile Number</span>
         <input type="number" name="anum" class="box" placeholder="94+number" id="" required>
         <span>Password</span>
         <input type="password" name="apassword" class="box" placeholder="Enter your password" id="" required>
         <span>Confirm Password</span>
         <input type="password" name="acpassword" class="box" placeholder="Enter your password" id="" required>
          
         <input type="submit" name="add_admin" value="Add Admin" class="btn" >
         
          
     </form>
 </div>';


    ?>
   </body>
   </html>
  