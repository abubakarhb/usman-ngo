<?php
    $hostname_fasaha = "localhost";
    $database_fasaha = "allonfasaha";
    $username_fasaha = "root";
    $password_fasaha = "";
    $allonfasaha = mysqli_connect($hostname_fasaha, $username_fasaha, $password_fasaha, $database_fasaha) or trigger_error(mysqli_error($allonfasaha),E_USER_ERROR);
