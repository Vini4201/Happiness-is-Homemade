<?php

include 'config.php';

session_start();
session_unset();
session_destroy();

header('location:/Website For Elderly People/welcome.html');

?>