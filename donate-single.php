<?php
include('./php/config/index.php');
$project_id = intval($_GET['projectid']);
ini_set('display_errors', 1);

if (isset($_POST['submit1'])) {
  $project_id = mysqli_real_escape_string($usman_ngo, $_POST['project_id']);
  $email = mysqli_real_escape_string($usman_ngo, $_POST['email']);
  $name = mysqli_real_escape_string($usman_ngo, $_POST['name']);
  $amount = mysqli_real_escape_string($usman_ngo, $_POST['amount']);

  // echo "well"; die;
    // form validation: ensure that the form is correctly filled ...
    if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['amount'])) {
      echo "<script>alert('Fill All Fields');</script>";
      echo "<script>window.location.href='./donate-single.php?projectid=" . $project_id . "';</script>";
    }


  $query = sprintf("INSERT INTO `donation_details`(`project_id`, `email`, `donator_name`, `amount_donated`) VALUES('$project_id','$email','$name','$amount')");
  //  print_r($query);die;
  $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

  if ($User_re) {
    $query =  "UPDATE `projects` SET `total_donation` = `total_donation` + '{$amount}' WHERE `id` = '{$project_id}';";
    //   print_r($query);die;
    $User_re2 = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));
    if ($User_re) {
      echo "<script>alert('Thank you for your Donation');</script>";
      echo "<script>window.location.href='./donate-single.php?projectid=" . $project_id . "';</script>";
    } else {
      echo "<script>alert('something went wrong with Project Amount Update');</script>";
    }
  } else {
    echo "<script>alert('something went wrong Submitting Donation Detail');</script>";
  }
}


if (isset($_POST['submit2'])) {
  $project_id = mysqli_real_escape_string($usman_ngo, $_POST['project_id']);
  $name = mysqli_real_escape_string($usman_ngo, $_POST['name']);
  $email = mysqli_real_escape_string($usman_ngo, $_POST['email']);
  $website = mysqli_real_escape_string($usman_ngo, $_POST['website']);
  $message = mysqli_real_escape_string($usman_ngo, $_POST['message']);

  

  // form validation: ensure that the form is correctly filled ...
  if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    echo "<script>alert('Fill All Fields');</script>";
    echo "<script>window.location.href='./donate-single.php?projectid=" . $project_id . "';</script>";
  }
// echo $project_id; die;

  $query = sprintf("INSERT INTO `project_comments`( `project_id`, `name`, `email`, `website`, `message`) VALUES ('$project_id','$name','$email','$website','$message')");
  //  print_r($query);die;
  $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

  if ($User_re) {
  
      echo "<script>alert('Cooment Posted ');</script>";
      echo "<script>window.location.href='./donate-single.php?projectid=" . $project_id . "';</script>";
  
  } else {
    echo "<script>alert('something went wrong');</script>";
    echo "<script>window.location.href='./donate-single.php?projectid=" . $project_id . "';</script>";
  }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Welfare - Free Bootstrap 4 Template by Colorlib</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Overpass:300,400,400i,600,700" rel="stylesheet">

  <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/ionicons.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">


  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/icomoon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
      <a class="navbar-brand" href="index.php">Welfare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item active"><a href="donate.php" class="nav-link">Donations</a></li>
          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
          <li class="nav-item"><a href="event.php" class="nav-link">Events</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <div class="hero-wrap" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <p class="breadcrumbs" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><span class="mr-2"><a href="index.php">Home</a></span> <span class="mr-2"><a href="blog.php">Donation</a></span> <span>Donation Details</span></p>
          <h1 class="mb-3 bread" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Donation Details</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section ftco-degree-bg">
    <div class="container">
      <div class="row">
        <?php
        $faculty = $usman_ngo->query("SELECT * FROM `projects` WHERE `id`= '{$project_id}'");
        $row1 = $faculty->fetch_array();
        ?>
        <div class="col-md-8 ftco-animate">
          <h2 class="mb-3"><a class="text-dark" href="#"><?php echo ucwords($row1['header']) ?></h2>

          <p>
            <img src="./images/<?php echo ($row1['img']) ?>" alt="" class="img-fluid">
          </p>
          <p><a class="text-dark" href="#"><?php echo ucwords($row1['description']) ?></p>


          <div class="pt-5 mt-5">
            <?php
            $result = $usman_ngo->query("SELECT COUNT(*) FROM `project_comments` WHERE `project_id`= '{$project_id}'");
            $row = $result->fetch_row();
            $count = $row[0];

            ?>
            <h3 class="mb-5"><?php echo  $count;  ?> Comments</h3>
            <ul class="comment-list">
              <?php
              $comments = $usman_ngo->query("SELECT * FROM `project_comments` WHERE `project_id`= '{$project_id}'");
              while ($row2 = $comments->fetch_array()) :
              ?>
                <li class="comment">
                  <div class="vcard bio">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3><?php echo ucwords($row2['name']) ?></h3>
                    <div class="meta">June 27, 2018 at 2:21pm</div>
                    <p><?php echo ucwords($row2['message']) ?></p>
                    <p><a href="#" class="reply">Reply</a></p>
                  </div>
                </li>

              <?php endwhile; ?>
            </ul>

          </div>

          <div class="comment-form-wrap pt-5">
            <h3 class="mb-5">Leave a comment</h3>
            <div class="form-group">
              <form action="#" method="post" class="p-5 bg-light">
                <input type="hidden" name="project_id" value="<?php echo $project_id ?>">

                <label class="mt-2 for="name">Name *</label>
                <input type="text" name="name" class="form-control" >

                <label class="mt-2 for="email">Email *</label>
                <input type="email" name="email" class="form-control" >

                <label class="mt-2 for="website">Website</label>
                <input type="text" class="form-control" name="website" >

                <label for="message" class="mt-2">Message</label>
                <textarea cols="10" rows="3" name="message" class="form-control"></textarea>

                <input type="submit" name="submit2" value="Post Comment" class="btn my-4 btn-primary">
              </form>
            </div>
          </div>
        </div> <!-- .col-md-8 -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h3 class="mb-3 text-dark text-center">Account Details</h3>
                <h5><a class="text-dark" href="#"><span>Donating For</span> <?php echo ucwords($row1['header']) ?> </h5>
                <h5><a class="text-dark" href="#"><span>Bank Name: </span> First Bank</h5>
                <h5><a class="text-dark" href="#"><span>Account Number: </span> 2098767845</h5>
                <h5><a class="text-dark" href="#"><span>Account Name: </span>John Doe</h5>
                <hr>
                <div class="mt-3">
                  <p class="lead text-center">Your details <span><small>(optional)</small> </span></p>
                  <div class="form-group">
                    <form action="#" method="post">
                      <input type="hidden" name="project_id" value="<?php echo $project_id ?>">
                      <label for="">Your Email</label>
                      <input type="email" class="form-control" name="email" id="">
                      <label class="mt-3" for="">Your Name</label>
                      <input type="text" class="form-control" name="name" id="">
                      <label class="mt-3" for="">Amount Donated</label>
                      <input type="number" class="form-control" name="amount" id="">
                      <!-- <input class="mt-2 btn btn-success" name="submit1" type="submit" value="Submit"> -->
                      <button type="submit" class="mt-2 btn btn-success" name="submit1">Submit</button>
                    </form>
                  </div>

                </div>
              </div>
              <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div> -->
            </div>
          </div>
        </div>
        <!-- Modal -->


        <div class="col-md-4 sidebar ftco-animate">
          <div class="sidebar-box">
            <form action="#" class="search-form">
              <div class="form-group btn bordered">
                <h3><a data-toggle="modal" data-target="#exampleModal" href="">Click to Make Donation for the Program</a> </h3>
              </div>
            </form>
          </div>



          <div class="sidebar-box ftco-animate">
            <h3>Recent Blog</h3>


            <?php
            $projects = $usman_ngo->query("SELECT * FROM blog  ORDER BY id DESC LIMIT 4");
            while ($row = $projects->fetch_array()) :
              $date =  ucwords($row['updated_at']);

            ?>

              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/<?php echo ($row['image']) ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="#"><?php echo ucwords($row['header']) ?></a></h3>
                  <div class="meta">
                    <div><a href="#"><span class="icon-calendar"></span><?php echo  date('Y-m-d', strtotime($date));  ?></a></div>
                    <div><a href="#"><span class="icon-person"></span> <?php echo ucwords($row['author']) ?></a></div>
                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>

          </div>

          <div class="sidebar-box ftco-animate">
            <h3>Tag Cloud</h3>
            <div class="tagcloud">
              <a href="#" class="tag-cloud-link">dish</a>
              <a href="#" class="tag-cloud-link">menu</a>
              <a href="#" class="tag-cloud-link">food</a>
              <a href="#" class="tag-cloud-link">sweet</a>
              <a href="#" class="tag-cloud-link">tasty</a>
              <a href="#" class="tag-cloud-link">delicious</a>
              <a href="#" class="tag-cloud-link">desserts</a>
              <a href="#" class="tag-cloud-link">drinks</a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section> <!-- .section -->

  <footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-3">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About Us</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
              <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
              <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-4">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Recent Blog</h2>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
            <div class="block-21 mb-4 d-flex">
              <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
              <div class="text">
                <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about</a></h3>
                <div class="meta">
                  <div><a href="#"><span class="icon-calendar"></span> July 12, 2018</a></div>
                  <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                  <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-2">
          <div class="ftco-footer-widget mb-4 ml-md-4">
            <h2 class="ftco-heading-2">Site Links</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Home</a></li>
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Donations</a></li>
              <li><a href="#" class="py-2 d-block">Donations</a></li>
              <li><a href="#" class="py-2 d-block">Event</a></li>
              <li><a href="#" class="py-2 d-block">Blog</a></li>
            </ul>
          </div>
        </div>
        <div class="col-md-3">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
              <ul>
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
        </div>
      </div>
    </div>
  </footer>



  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>