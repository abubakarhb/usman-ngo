<?php
include('../php/config/index.php');
ini_set('display_errors', 1);
// $event_id = intval($_GET['eventid']);
// echo $event_id; die;

if (isset($_POST['submit'])) {
    $img = mysqli_real_escape_string($usman_ngo, $_POST['img']);
    $header = mysqli_real_escape_string($usman_ngo, $_POST['header']);
    $description = mysqli_real_escape_string($usman_ngo, $_POST['description']);
    $total_donation = mysqli_real_escape_string($usman_ngo, $_POST['total_donation']);
    $amount_donated = mysqli_real_escape_string($usman_ngo, $_POST['amount_donated']);

    // form validation: ensure that the form is correctly filled ...
    if (empty($_POST['img']) || empty($_POST['header']) || empty($_POST['description']) || empty($_POST['total_donation']) || empty($_POST['amount_donated'])) {
        echo "<script>alert('Fill All Fields');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    }
    //    print_r($amount_donated);die;
    $query = sprintf("INSERT INTO `projects`(`img`, `header`, `description`, `total_donation`, `amount_donated`) VALUES ('$img','$header','$description','$total_donation','$amount_donated')");
    //   print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {

        echo "<script>alert('project Created Successfully');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    } else {
        echo "<script>alert('something went wrong');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    }
}
if (isset($_POST['submit2'])) {
    $img = mysqli_real_escape_string($usman_ngo, $_POST['img']);
    $header = mysqli_real_escape_string($usman_ngo, $_POST['header']);
    $description = mysqli_real_escape_string($usman_ngo, $_POST['description']);
    $total_donation = mysqli_real_escape_string($usman_ngo, $_POST['total_donation']);
    $amount_donated = mysqli_real_escape_string($usman_ngo, $_POST['amount_donated']);

    // form validation: ensure that the form is correctly filled ...
    if (empty($_POST['img']) || empty($_POST['header']) || empty($_POST['description']) || empty($_POST['total_donation']) || empty($_POST['amount_donated'])) {
        echo "<script>alert('Fill All Fields');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    }
    print_r($amount_donated);
    die;
    $query = sprintf("INSERT INTO `projects`(`img`, `header`, `description`, `total_donation`, `amount_donated`) VALUES ('$img','$header','$description','$total_donation','$amount_donated')");
    //   print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {

        echo "<script>alert('project Created Successfully');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    } else {
        echo "<script>alert('something went wrong');</script>";
        echo "<script>window.location.href='./admin-project.php';</script>";
    }
}


if (isset($_POST['submit1'])) {
    $id = mysqli_real_escape_string($usman_ngo, $_POST['id']);
    $amount = mysqli_real_escape_string($usman_ngo, $_POST['amount']);

    // form validation: ensure that the form is correctly filled ...
    if (empty($_POST['amount'])) {
        echo "<script>alert('Fill All Fields');</script>";
        echo "<script>window.location.href='./dashboard.php';</script>";
    }
    //    print_r($amount);die;
    $row22 = "SELECT * FROM `services` WHERE `id`= '{$id}'";
    $result22 = mysqli_query($usman_ngo, $row22) or die(mysqli_error($usman_ngo));
    $row11 = mysqli_fetch_assoc($result22);
    // print_r($user_id); die;

    if ($row11 > 1) {

        $query =  "UPDATE `services` SET `people_number` = '{$amount}' WHERE `id` = '{$id}'";

        //   print_r($query);die;
        $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

        if ($User_re) {
            echo "<script>alert('Children Number Successfully Updated');</script>";
            echo "<script>window.location.href='./dashboard.php';</script>";
        } else {
            echo "<script>alert('something went wrong');</script>";
            echo "<script>window.location.href='./dashboard.php';</script>";
        }
    } else {
        echo "<script>alert('No Data for this Record');</script>";
        echo "<script>window.location.href='./dashboard.php';</script>";
    }
}

// process image upload
if (isset($_POST['submitImage'])) {
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($fileName);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    // echo  $fileName ; die;

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        echo "<script>window.location.href='./admin-gallery';</script>";
    }

    if ($fileError === 0) {
        if ($fileSize < 1000000) {
            move_uploaded_file($fileTmpName, $target_file);

            // insert image data into database
            $sql = "INSERT INTO `gallery`(`filename`, `filepath`) VALUES ('$fileName', '$target_dir')";
            if ($usman_ngo->query($sql) === true) {
                echo "<script>alert('Image uploaded and saved to database.');</script>";
                echo "<script>window.location.href='./admin-gallery';</script>";
            } else {
                echo "<script>alert('something went wrong');</script>";
                echo "<script>window.location.href='./admin-gallery';</script>";
            }
        } else {
            echo "<script>alert('Your file is too big!');</script>";
            echo "<script>window.location.href='./admin-gallery';</script>";
        }
    } else {
        echo "<script>alert('There was an error uploading your file!');</script>";
        echo "<script>window.location.href='./admin-gallery';</script>";
    }
}
