<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
   $select->execute([$email, $pass]);
   $row = $select->fetch(PDO::FETCH_ASSOC);

   if($select->rowCount() > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:user_page.php');

      }else{
         $message[] = 'no user found!';
      }
      
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  
   <link rel="stylesheet" href="css/style.css"> -->

<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&display=swap');

:root{
   --blue:#0097e6;
   --orange:#f39c12;
   --red:#e74c3c;
   --white:#fff;
   --light-color:#aaa;
   --black:#222;
   --light-bg:#333;
}

*{
   font-family: 'Nunito', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
}

*::-webkit-scrollbar{
   height: 5px;
   width:10px;
}

*::-webkit-scrollbar-track{
   background-color: transparent;
}

*::-webkit-scrollbar-thumb{
   background-color: var(--blue);
}

html{
   font-size: 62.5%;
   overflow-x: hidden;
   background-color: white;
   background-image: url('images/registration.jpg');
   background-size: cover;
}

.message{
   position: sticky;
   top:0;
   max-width: 1200px;
   padding:1.5rem 2rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   gap:1.5rem;
   z-index: 1000;
   background-color: #fff;
   margin:0 auto;
}

.message span{
   color:var(--white);
   font-size: 2rem;
}

.message i{
   color:var(--red);
   font-size: 2.5rem;
   cursor: pointer;
}

.message i:hover{
   color:var(--white);
}

.title{
   padding:1.5rem 1rem;
   text-align: center;
   background-color: var(--white);
   font-size: 3rem;
   text-transform: uppercase;
   color:var(--red);
}

.title span{
   color:var(--red);
}

.btn,
.delete-btn,
.option-btn{
   display: block;
   width: 100%;
   border-radius: .5rem;
   color:var(--white);
   font-size: 1.8rem;
   cursor: pointer;
   padding:1rem 3rem;
   text-transform: capitalize;
   text-align: center;
   margin-top: 1rem;
}

.btn{
   background-color: #CB8E66;
}

.delete-btn{
   background-color: var(--red);
}

.option-btn{
   background-color: var(--orange);
}

.btn:hover,
.delete-btn:hover,
.option-btn:hover{
   background-color: var(--white);
   color:var(--black);
}

.flex-btn{
   display: flex;
   flex-wrap: wrap;
   gap:1rem;
}

.flex-btn > *{
   flex:1;
}

.form-container{
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
   min-height: 100vh;
}

.form-container form{
   width: 50rem;
   border-radius: .5rem;
   background-color: #545981;
   padding:2rem;
   text-align: center;
}

.form-container form h3{
   font-size: 3rem;
   margin-bottom: 1rem;
   color: #CAB29F;
   text-transform: uppercase;
}

.form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color: gray;
   background-color: #E9EAEC;
   margin:1rem 0;
}

.form-container form p{
   font-size: 2.3rem;
   color:var(--light-color);
   padding:1rem 0;
}

.form-container form p a{
   color: #EF7C8E;
}

.form-container form p a:hover{
   text-decoration: underline;
}

.profile-container{
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
   min-height: 100vh;
}

.profile-container .profile{
   width: 40rem;
   border-radius: .5rem;
   background-color: var(--black);
   padding:2rem;
   text-align: center;
}

.profile-container .profile img{
   height: 20rem;
   width: 20rem;
   border-radius: 50%;
   object-fit: cover;
   margin-bottom: .5rem;
}

.profile-container .profile h3{
   font-size: 2.5rem;
   padding:.5rem 0;
   color:var(--white);
}

.update-profile-container{
   display: flex;
   align-items: center;
   justify-content: center;
   padding:2rem;
   min-height: 100vh;
}

.update-profile-container form{
   width: 70rem;
   border-radius: .5rem;
   background-color: var(--black);
   padding:2rem;
   text-align: center;
}

.update-profile-container form .flex{
   text-align: left;
   display: flex;
   flex-wrap: wrap;
   justify-content: space-between;
}

.update-profile-container form .flex .inputBox{
   width: 49%;
}

.update-profile-container form img{
   height: 20rem;
   width: 20rem;
   border-radius: 50%;
   margin-bottom: 1rem;
}

.update-profile-container form .flex .inputBox span{
   font-size: 2rem;
   color:var(--light-color);
   display: block;
   padding-top: 1rem;
}

.update-profile-container form .flex .inputBox .box{
   width: 100%;
   padding:1.2rem 1.4rem;
   border-radius: .5rem;
   font-size: 1.8rem;
   color:var(--white);
   margin:1rem 0;
   background-color: var(--light-bg);
}

/*Volunteer Login Button*/
.text_link .volunteer_login {
   margin-top: -110px;
   margin-left: 40%;
   font-size: 20px;
}

.volunteer_login a {
   color: #de5f72;
}
</style>

</head>
<body>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>
   
<section class="form-container">

   <form action="" method="post" enctype="multipart/form-data">
      <h3>Senior Citizen Login</h3>
      <input type="email" required placeholder="enter your email" class="box" name="email">
      <input type="password" required placeholder="enter your password" class="box" name="pass">
      <p>don't have an account? <a href="register.php">register now</a></p>
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>

<section class="text_link">
   <div class="volunteer_login">
      <h1><a href="volunteer_login.php">Volunteer Login -></a></h1>
   </div>
</section>

</body>
</html>