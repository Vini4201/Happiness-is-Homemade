<?php

include 'volunteer_config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:volunteer_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>Volunteer Page</title>

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
   background-color: #bcbcbd;
   background-image: url('images/v_footer1.jpg');
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
   background-color: whitesmoke;
   font-size: 3rem;
   text-transform: uppercase;
   color: #de5f72;
}

.title span{
   color: #de5f72;
}

.btn,
.delete-btn,
.option-btn{
   display: block;
   width: 100%;
   border-radius: .5rem;
   color: black;
   font-size: 1.8rem;
   cursor: pointer;
   padding:1rem 3rem;
   text-transform: capitalize;
   text-align: center;
   margin-top: 1rem;
}

.btn{
   background-color: #FAD02C;
}

.delete-btn{
   background-color: #E9EAEC;
}

.option-btn{
   background-color: #90ADC6;
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
   background-color: var(--black);
   padding:2rem;
   text-align: center;
}

.form-container form h3{
   font-size: 3rem;
   margin-bottom: 1rem;
   color:var(--white);
   text-transform: uppercase;
}

.form-container form .box{
   width: 100%;
   border-radius: .5rem;
   padding:1.2rem 1.4rem;
   font-size: 1.8rem;
   color:var(--white);
   background-color: var(--light-bg);
   margin:1rem 0;
}

.form-container form p{
   font-size: 2.3rem;
   color:var(--light-color);
   padding:1rem 0;
}

.form-container form p a{
   color:var(--red);
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
   background-color: #545981;
   padding:2rem;
   text-align: center;
   margin-top: -60px;
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
   margin-top: -80px;
   margin-left: 43%;
   font-size: 20px;
}

.volunteer_login a {
   color: #de5f72;
}
   </style>

</head>
<body>

<h1 class="title"> <span>Volunteer</span> profile page </h1>

<section class="profile-container">

   <?php
      $select_profile = $conn->prepare("SELECT * FROM `volunteers` WHERE id = ?");
      $select_profile->execute([$user_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
   ?>

   <div class="profile">
      <img src="image/<?= $fetch_profile['image']; ?>" alt="">
      <h3><?= $fetch_profile['name']; ?></h3>
      <a href="volunteer_profile_update.php" class="btn">update profile</a>
      <a href="volunteer_logout.php" class="delete-btn">logout</a>
      <div class="flex-btn">
         <a href="volunteer_home.html" class="option-btn">Back to Homepage</a>
         <a href="volunteer_registration.php" class="option-btn">register</a>
      </div>
   </div>

</section>

<section class="text_link">
   <div class="volunteer_login">
      <h1><a href="#">Senior Citizen? -></a></h1>
   </div>
</section>

</body>
</html>