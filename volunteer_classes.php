<?php
  // Create database connection
  $db = mysqli_connect("localhost", "root", "", "add_class");

  // Initialize message variable
  $msg = "";

  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  	// Get image name
  	$image = $_FILES['image']['name'];
    //Get heading
    $image_heading = mysqli_real_escape_string($db, $_POST['image_heading']);
  	// Get text
  	$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
    //Get volunteer name
    $senior_name = mysqli_real_escape_string($db, $_POST['senior_name']);
    //Get date
    $class_date = mysqli_real_escape_string($db, $_POST['class_date']);
    //Get location
    $location = mysqli_real_escape_string($db, $_POST['location']);
    //Get address
    $address = mysqli_real_escape_string($db, $_POST['address']);
    //Get google form link
    $google_form = mysqli_real_escape_string($db, $_POST['google_form']);

  	// image file directory
  	$target = "images/".basename($image);

  	$sql = "INSERT INTO images (image, image_heading, image_text, senior_name, class_date, location, google_form) VALUES ('$image', '$image_heading', '$image_text', '$senior_name', '$class_date', '$location', '$google_form')";
  	// execute query
  	mysqli_query($db, $sql);

  	if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
  		$msg = "Image uploaded successfully";
  	}else{
  		$msg = "Failed to upload image";
  	}
  }
  $result = mysqli_query($db, "SELECT * FROM images");
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF=8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classes</title>
    <link rel="stylesheet" href="activities.css">
    <script src="activities.js"></script>

    <!-- for filter -->
   <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>


    <!--favicon-->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
    <!--icons-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /*Add Image*/

        input[type="file"] {
        position: absolute;
        z-index: -1;
        top: 15px;
        left: 20px;
        font-size: 15px;
        color: #b8b8b8;
        }
        .button-wrap {
        position: relative;
        }
        .button {
        display: inline-block;
        background-color: #4361ee;
        border-radius: 10px;
        border: 4px double #cccccc;
        color: #ffffff;
        text-align: center;
        font-size: 10px;
        padding: 8px;
        width: 100px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 5px;
        }
        .button:hover {
        background-color: #7289f1;
        }

        /*Submit*/
        .submit {
        background-color: #3da35d;
        border-radius: 12px;
        border: 0;
        box-sizing: border-box;
        color: #eee;
        cursor: pointer;
        font-size: 18px;
        height: 40px;
        margin-top: 38px;
        text-align: center;
        width: 20%;
        margin-left: 40%;
        }

        .submit:active {
        background-color: #8db38b;
        }
    </style>

</head>

<body>

    <!------------ HEADER ----------->
    <header>
        <!--language settings-->
        <div class="alert">
            <!--google translate button-->
            <div id="google_translate_element"></div>
            <script type="text/javascript">
                function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                }
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            <!--alert message-->
            <div class="container">
              <p class="alert-text">Change the language of your page from here</p>
            </div>            
        </div>

        <div class="header-top" data header>
            <div class="container">

                <!--logo text-->
                <a href="#" class="logo">
                    <img src="images/Logo_text 1.png" alt="Happiness Is Homemade">
                </a>  
                       

            </div>
        </div>

        <!--navbar-->
        <nav class="navbar navbar-expand-md navbar-light">
						
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto py-4 py-md-0">
                
                    <li class="nav-item">
                        <a class="nav-link" href="/Website For Elderly People/volunteer_home.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Website For Elderly People/volunteer_activities.php">Activities</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Classes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Website For Elderly People/volunteer_suggestions.html">Suggestions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Website For Elderly People/volunteer_volunteerprofile.html">Volunteer Profiles</a>
                    </li>
                </ul>
            </div>
            
        </nav>     

    </header>

<!--Activities Info Card-->
<section class="activities_info">

<div class="activity">
    <h2 class="title">
        <span class="title-word title-word-1">Classes</span>
      </h2>
    </div>

<!--Filter Buttons-->
<!-- <div id="myBtnContainer">
    <button class="btn active" onclick="filterSelection('all')">All</button>
    <button class="btn" onclick="filterSelection('cars')">Mumbai</button>
    <button class="btn" onclick="filterSelection('animals')">Pune</button>
    <button class="btn" onclick="filterSelection('fruits')">Nagpur</button>
    <button class="btn" onclick="filterSelection('colors')">Amravati</button>
</div> -->

<div id="filters">
            <span>Fetch results by &nbsp</span>
            <select name="fetchval" id="fetchval">
            <option value="" disabled="" selected="">Select filter</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Pune">Pune</option>
            <option value="Nagpur">Nagpur</option>
            <option value="Amravati">Amravati</option>
            </select>
        </div>

<div class="containers">
<?php
while ($row = mysqli_fetch_array($result)) {
    echo "<div class='activities_container'>";
      //  echo "<div class='filterDiv cars'>";
            echo "<article class='postcard light green'>";
            // Image
                echo "<a class='postcard__img_link' href='#'>";
                echo "<img class='postcard__img' src='images/".$row['image']."'/>";
                echo "</a>";
                //Information
                    echo "<div class='postcard__text t-dark'>";
                        //Activity Heading
                        echo "<h1 class='postcard__title green'><a href='#'>".$row['image_heading']."</a></h1>";
                        //Activity Date
                        echo "<div class='postcard__subtitle small'>";
                        echo "<time datetime='2020-05-25 12:00:00'>";
                        echo "<i class='fas fa-calendar-alt mr-2'></i>".$row['class_date']."";
                        echo "</time>";
                        echo "</div>";
                        echo "<div class='postcard__bar'></div>";
                        //Activity Description
                        echo "<div class='postcard__preview-txt'>";
                        echo "".$row['image_text']."";
                        echo "</div>";
                        //Tagbox
                        echo "<ul class='postcard__tagbox'>";
                            //Location
                            echo "<li class='tag__item'><i class='fas fa-tag mr-2'></i>".$row['location']."</li>";
                            //Address
                            echo "<li class='tag__item'><i class='fas fa-note mr-2'></i>".$row['address']."</li>";
                            //Volunteer Name
                            echo "<li class='tag__item'><i class='fas fa-clock mr-2'></i>".$row['senior_name']."</li>";
                            //Google Form
                            echo "<li class='tag__item play green'>";
                            echo '<a href="' . $row['google_form'] . '"><i class="fas fa-play mr-2"></i>Google Form</a>';
                            echo "</li>";
                        echo "</ul>";
                    echo "</div>";

            echo "</article>";
       // echo "</div>";

    echo "</div>";
}
?>
</div>

</section>

<script>
        $(document).ready(function(){
        $("#fetchval").on('change',function(){
        var value=$(this).val();
        //alert(value);
        $.ajax({
        url:"vc_fetch.php",
        type:'POST',
        data:'request=' + value,
        beforeSend:function(){
        $(".containers").html("<span>Working...</span>");
        },
        success:function(data){
        $(".containers").html(data);
        }
        });
        });
        });
    </script>

<!--------- FOOTER ----------->
<footer class="footer-distributed">

    <div class="footer-left">

        <img src="images/Logo_text 1.png" alt="Happiness Is Homemade">

        <p class="footer-links">
            <a href="#" class="link-1">Home</a>
            
            <a href="#">Activities</a>
        
            <a href="#">Classes</a>
        
            <a href="#">Suggestions</a>
            
            <a href="#">About</a>
            
            <a href="#">Contact</a>
        </p>

        <p class="footer-company-name">Happiness Is Homemade © 2022</p>
    </div>

    <div class="footer-center">

        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Survey No. 12, 13 Kasarvadavli, Thane</span> Maharashtra India</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>+91 8462137521</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a href="mailto:hih@company.com">hih@company.com</a></p>
        </div>

    </div>

    <div class="footer-right">

        <p class="footer-company-about">
            <span>About the company</span>
            Happiness Is Homemade aims towards reducing the boredom of our older adults by providing them width
            various recreational activities with the help of volunteers.
        </p>

        <div class="footer-icons">

            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>

        </div>

    </div>

</footer>


</body>

</html>