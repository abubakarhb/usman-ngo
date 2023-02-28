<?php
    $hostname_fasaha = "localhost";
    $database_fasaha = "usman_ngo";
    $username_fasaha = "root";
    $password_fasaha = "";
    $usman_ngo = mysqli_connect($hostname_fasaha, $username_fasaha, $password_fasaha, $database_fasaha) or trigger_error(mysqli_error($usman_ngo),E_USER_ERROR);
