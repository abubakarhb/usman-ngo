<?php



function check_db_query_staus($db_state, $db_actions)
{
    include "config/index.php";
    $query_User_re = sprintf($db_state);
    $User_re = mysqli_query($usman_ngo, $query_User_re) or die(mysqli_error($usman_ngo));
    $row_User_re = mysqli_fetch_assoc($User_re);
    $totalRows_User_re = mysqli_num_rows($User_re);
    switch ($db_actions) {
        case 'DEL':
            if ($User_re) {
                $returnResponse = ['status' => 1, 'message' => "Deleted successfully"];
                return ($returnResponse);
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;
        case 'UPD':
            if ($User_re) {
                $returnResponse = ['status' => 1, 'message' => "Updated successfully"];
                return ($returnResponse);
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;
        case 'CHK':
            if ($User_re) {
                if ($totalRows_User_re > 0) {
                    $arr = ['status' => 1, 'message' => $row_User_re];
                    return ($arr);
                } else {
                    $returnResponse = ['status' => 0, 'message' => "try again"];
                    return ($returnResponse);
                }
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;

        default:
            break;
    }
}

function check_db_query_staus1($db_state, $db_actions)
{
    include "config/index.php";
    $query_User_re = sprintf($db_state);
    $User_re = mysqli_query($usman_ngo, $query_User_re) or die(mysqli_error($usman_ngo));

    $totalRows_User_re = mysqli_num_rows($User_re);
    switch ($db_actions) {
        case 'DEL':
            if ($User_re) {
                $returnResponse = ['status' => 1, 'message' => "Deleted successfully"];
                return ($returnResponse);
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;
        case 'UPD':
            if ($User_re) {
                $returnResponse = ['status' => 1, 'message' => "Updated successfully"];
                return ($returnResponse);
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;
        case 'CHK':
            if ($User_re) {
                if ($totalRows_User_re > 0) {
                    $all = [];
                    while ($row_User_re = mysqli_fetch_assoc($User_re)) {
                        $all[] = $row_User_re;
                        // $User_re11 = mysqli_query($ibsConnection, "INSERT INTO mda(`fullname`) VALUE('{$row_User_re['COL_3']}')") or die(mysqli_error($ibsConnection));
                    };
                    $arr = ['status' => 1, 'message' => $all];
                    return ($arr);
                } else {
                    $returnResponse = ['status' => 0, 'message' => "try again"];
                    return ($returnResponse);
                }
            } else {
                $returnResponse = ['status' => 0, 'message' => "try again"];
                return ($returnResponse);
            }
            break;

        default:
            break;
    }
}

function childrenService()
{
    $pull_data = check_db_query_staus1("SELECT * FROM `services` ", "CHK");
    exit(json_encode($pull_data));
}

function UpdateChildrenService()
{
    //   print_r($data); die;
    include "config/index.php";
    $id = $_GET['id'];
    $number = $_GET['number'];

    $row22 = "SELECT * FROM `services` WHERE `id`= '{$id}'";
    $result22 = mysqli_query($usman_ngo, $row22) or die(mysqli_error($usman_ngo));
    $row11 = mysqli_fetch_assoc($result22);
    $user_id = $row11['people_number'];
    // print_r($user_id); die;

    if ($row11 > 1) {

        $query =  "UPDATE `services` SET `people_number` = '{$number}' WHERE `id` = '{$id}'";

        //   print_r($query);die;
        $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

        if ($User_re) {
            $arr = ["status" => 1, "message" => "Children Number Successfully Updated "];
            exit(json_encode($arr));
        } else {
            $error_creating = ["Error" => "Invalid operation"];
            exit(json_encode($error_creating));
        }
    } else {
        $error_creating = ["Error" => "No Data for this Record"];
        exit(json_encode($error_creating));
    }
}

function ourProjects($data)
{
    include "config/index.php";
    include "config/enctp.php";
    $img = $data->img;
    $header = $data->header;
    $description = $data->description;
    $total_donation = $data->total_donation;
    $amount_donated = $data->amount_donated;

    // print_r($total_donation ); die;

    $query = sprintf("INSERT INTO `projects`(`img`, `header`, `description`, `total_donation`, `amount_donated`) VALUES ('$img','$header','$description','$total_donation','$amount_donated')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "Project Created"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}
function getAllProjects()
{
    $pull_data = check_db_query_staus1("SELECT * FROM `projects` ", "CHK");
    exit(json_encode($pull_data));
}
function editSingleProjects($data)
{
    $pull_data = check_db_query_staus1("SELECT * FROM `projects` WHERE `id`= '{$data}' ", "CHK");
    exit(json_encode($pull_data));
}
function ourBlogs($data)
{
    include "config/index.php";
    $author = $data->author;
    $image = $data->image;
    $header = $data->header;
    $description = $data->description;

    // print_r($description); die;

    $query = sprintf("INSERT INTO `blog`(`author`, `image`, `header`, `description`) VALUES('$author','$image','$header','$description')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "Blog Created"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}
function getAllBlogs()
{
    $pull_data = check_db_query_staus1("SELECT * FROM `blog` ", "CHK");
    exit(json_encode($pull_data));
}
function editSingleBlogs($data)
{
    $pull_data = check_db_query_staus1("SELECT * FROM `blog` WHERE `id`= '{$data}' ", "CHK");
    exit(json_encode($pull_data));
}
function ourEvents($data)
{
    include "config/index.php";
    $image = $data->image;
    $organizer = $data->organizer;
    $header = $data->header;
    $description = $data->description;
    $date = $data->date;
    $time_from = $data->time_from;
    $time_to = $data->time_to;
    $location = $data->location;

    // print_r($description); die;

    $query = sprintf("INSERT INTO `event2`(`image`, `organizer`, `header`, `description`, `date`, `time_from`, `time_to`, `location`) VALUES('$image','$organizer','$header','$description','$date','$time_from','$time_to','$location')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "Events Created"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}

function getAllEvents()
{
    $pull_data = check_db_query_staus1("SELECT * FROM `event2` ", "CHK");
    exit(json_encode($pull_data));
}
function editSingleEvents($data)
{
    $pull_data = check_db_query_staus1("SELECT * FROM `event2` WHERE `id`= '{$data}' ", "CHK");
    exit(json_encode($pull_data));
}

function contactUs($data)
{
    include "config/index.php";
    $name = $data->name;
    $email = $data->email;
    $number = $data->number;
    $subject = $data->subject;
    $msg = $data->msg;

    // print_r($subject); die;

    $query = sprintf("INSERT INTO `contact_us`( `name`, `email`, `number`, `subject`, `msg`) VALUES('$name','$email','$number','$subject','$msg')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "Contact Us Saved"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}
function aboutUs($data)
{
    include "config/index.php";
    $image = $data->image;
    $title = $data->title;
    $content = $data->content;

    // print_r($image); die;

    $query = sprintf("INSERT INTO `about_us`(`image`, `title`, `content`) VALUES('$image','$title','$content')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "About Us Saved"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}

function UpdateaboutUs($data)
{
   
    include "config/index.php";
    $id = $data->id;
    $image = $data->image;
    $title = $data->title;
    $content = $data->content;

    //    print_r($content); die;

    $row22 = "SELECT * FROM `about_us` WHERE `id`= '{$id}'";
    $result22 = mysqli_query($usman_ngo, $row22) or die(mysqli_error($usman_ngo));
    $row11 = mysqli_fetch_assoc($result22);
   

    if ($row11 > 1) {
        $query =  "UPDATE `about_us` SET `image` = '{$image}',`title` = '{$title}',`content` = '{$content}' WHERE `id` = '{$id}'";

        //   print_r($query);die;
        $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

        if ($User_re) {
            $arr = ["status" => 1, "message" => "about us Successfully Updated "];
            exit(json_encode($arr));
        } else {
            $error_creating = ["Error" => "Invalid operation"];
            exit(json_encode($error_creating));
        }
    } else {
        $error_creating = ["Error" => "No Data for this Record"];
        exit(json_encode($error_creating));
    }
}

function blogComment($data)
{
    include "config/index.php";
    $blog_id = $data->blog_id;
    $name = $data->name;
    $email = $data->email;
    $website = $data->website;
    $message = $data->message;

    // print_r($message); die;

    $query = sprintf("INSERT INTO `blog_commenets`(`blog_id`, `name`, `email`, `website`, `message`) VALUES ('$blog_id','$name','$email','$website','$message')");
    //    print_r($query);die;
    $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

    if ($User_re) {
        $arr = ["status" => 1, "message" => "Comment send Us Saved"];
        exit(json_encode($arr));
    } else {
        $error_creating = ["Error" => "Invalid operation"];
        exit(json_encode($error_creating));
    }
}
function getblogComment()
{
    $pull_data = check_db_query_staus1("SELECT * FROM `blog_commenets` ORDER BY id DESC ", "CHK");
    exit(json_encode($pull_data));
}