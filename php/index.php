<?php

declare(strict_types=1);
header('Content-type:application/json;charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'gate.php';
   if (isset($_GET['childrenService'])) {
    childrenService($_GET);
    } elseif (isset($_GET['updateChildrenService'])) {
    updateChildrenService($_GET);
    }  elseif (isset($_GET['getAllProjects'])) {
    getAllProjects($_GET);
    } elseif (isset($_GET['editSingleProjects'])) {
    editSingleProjects($_GET['id']);
    } elseif (isset($_GET['getAllBlogs'])) {
    getAllBlogs($_GET['id']);
    } elseif (isset($_GET['editSingleBlogs'])) {
    editSingleBlogs($_GET['id']);
    }  elseif (isset($_GET['getAllEvents'])) {
    getAllEvents($_GET['id']);
    } elseif (isset($_GET['editSingleEvents'])) {
    editSingleEvents($_GET['id']);
    }  elseif (isset($_GET['getblogComment'])) {
    getblogComment($_GET['id']);
    } 
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'gate.php';
    $entityBody = file_get_contents('php://input');
    // price_update_add($entityBody);
    if (!empty($entityBody)) {
        $data = (array) json_decode($entityBody);
        if ($data['endpoint'] == "ourProjects") {
            ourProjects($data['data']);
        } elseif ($data['endpoint'] == "ourBlogs") {
            ourBlogs($data['data']);
        }  elseif ($data['endpoint'] == "ourEvents") {
            ourEvents($data['data']);
        }  elseif ($data['endpoint'] == "contactUs") {
            contactUs($data['data']);
        } elseif ($data['endpoint'] == "aboutUs") {
            aboutUs($data['data']);
        } elseif ($data['endpoint'] == "blogComment") {
            blogComment($data['data']);
        } 
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    include 'gate.php';
    $entityBody = file_get_contents('php://input');
    // price_update_add($entityBody);
    if (!empty($entityBody)) {
        $data = (array) json_decode($entityBody);
        if ($data['endpoint'] == "UpdateaboutUs") {
           UpdateaboutUs($data['data']);
        } 
    }
}
