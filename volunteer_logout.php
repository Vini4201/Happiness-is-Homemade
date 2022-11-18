<?php

include 'volunteer_config.php';

session_start();
session_unset();
session_destroy();

header('location:welcome.html');

?>