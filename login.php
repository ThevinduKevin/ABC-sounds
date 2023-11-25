<?php 
     include 'config.php';
     session_start();
      

     if(isset($_POST['submit'])){

        
        $lemail = mysqli_real_escape_string($conn, $_POST['lemail']);
        $lpass = mysqli_real_escape_string($conn, md5($_POST['lpass']));
        
     
        $choose=mysqli_query($conn,"SELECT *FROM users WHERE email='$lemail' and upassword ='$lpass'");
     
        if(mysqli_num_rows($choose)>0){
            
         $row=mysqli_fetch_assoc($choose);
         $_SESSION['user_id'] = $row['user_id'];
         header('Location:home_page.php');
        }
        else{
            $message[]='user input not match';
            // header('Location:login.php');
        }
    }


     


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
      <!-- linking style sheets -->
      <link rel="stylesheet" href="login_sign_style.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="sign-form-container">
        <div id="close-login-btn" class="fa-solid fa-xmark"></div>

        <?php
          if(isset($_SESSION['user_id'])){//change1
            $id=$_SESSION['user_id'];
            $choose=mysqli_query($conn,"SELECT *FROM users WHERE user_id='$id'");
            $row=mysqli_fetch_assoc($choose);
            echo'
            <div class="logbox">
            <h style="font-size: 40px; color: green; font-weight: 1000;">About Me</h> <br>
            <div class="propic"><i class=\'bx bx-user-circle bx-tada\' ></i></div><br>
            <span>Name: '.$row['user_name'].'</span>
            <span>Gmail: '.$row['email'].'</span>
            <span>Phone number: +94'.$row['user_number'].'</span><br><br><br>
            <a href="home_page.php?logout" class="btn">logout</a>
            </div>
            ';
          }
          else{
            echo ' <form action=""  method="POST" enctype="multipart/form-data">
                                         
                   <h3>Login</h3>;';

                   
                   if(isset($message)){
                    foreach($message as $message){
                       echo '<div class="message">'.$message.'</div>';
                    }
                 }
                 
                 echo '
                      <span>Email</span>
                      <input type="email" name="lemail" class="box" placeholder="Enter your email"  required>
                      <span>Password</span>
                      <input type="password" name="lpass" class="box" placeholder="Enter your password" required>
                                           
                      <input type="submit" name="submit" value="login" class="btn" >   
                                 
                      <p>Don"t have an account? <a href="sign.php">Create an account</a></p>
                    </form>';

              }
        ?>
    </div>


    
</body>
</html>