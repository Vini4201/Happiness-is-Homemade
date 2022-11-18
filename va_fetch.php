<?php
    include("config2.php");
    if(isset($_POST['request'])){
    $request = $_POST['request'];
    $query="SELECT * FROM images WHERE location='$request'";
    $result = mysqli_query($db,$query);
    $count = mysqli_num_rows($result);
?>

<?php
    while($row = mysqli_fetch_assoc($result)){
        echo "<div class='activities_container'>";
              //  echo "<div class='filterDiv cars'>";
                    echo "<article class='postcard light blue'>";
                    // Image
                        echo "<a class='postcard__img_link' href='#'>";
                        echo "<img class='postcard__img' src='images/".$row['image']."'/>";
                        echo "</a>";
                        //Information
                            echo "<div class='postcard__text t-dark'>";
                                //Activity Heading
                                echo "<h1 class='postcard__title blue'><a href='#'>".$row['image_heading']."</a></h1>";
                                //Activity Date
                                echo "<div class='postcard__subtitle small'>";
                                echo "<time datetime='2020-05-25 12:00:00'>";
                                echo "<i class='fas fa-calendar-alt mr-2'></i>".$row['activity_date']."";
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
                                    echo "<li class='tag__item'><i class='fas fa-clock mr-2'></i>".$row['volunteer_name']."</li>";
                                    //Google Form
                                    echo "<li class='tag__item play blue'>";
                                    echo '<a href="' . $row['google_form'] . '"><i class="fas fa-play mr-2"></i>Google Form</a>';
                                    echo "</li>";
                                    //Delete Button
                                    if (isset($_GET['del'])) {
                                        $id = $_GET['del'];
                                        mysqli_query($db, "DELETE FROM images WHERE id=$id");
                                        $_SESSION['message'] = "Address deleted!"; 
                                    }
                                    echo "<li class='delete_button'>";
                                    echo '<a href="volunteer_activities.php?del=' . $row['id'] . '"><i class="fas fa-xmark mr-2"></i>Delete</a>';
                                    echo "</li>";
                                echo "</ul>";
                            echo "</div>";

                    echo "</article>";
              //  echo "</div>";

            echo "</div>";
        }
}
?>