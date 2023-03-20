<?php include('./php/config/index.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['submit1'])) {
  $project_id = mysqli_real_escape_string($usman_ngo, $_POST['project_id']);
  $email = mysqli_real_escape_string($usman_ngo, $_POST['email']);
  $name = mysqli_real_escape_string($usman_ngo, $_POST['name']);
  $amount = mysqli_real_escape_string($usman_ngo, $_POST['amount']);

  // echo $project_id; die;
  // form validation: ensure that the form is correctly filled ...
  if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['amount'])) {
    echo "<script>alert('Fill All Fields');</script>";
    echo "<script>window.location.href='./index.php';</script>";
  }


  $query = sprintf("INSERT INTO `donation_details`(`project_id`, `email`, `donator_name`, `amount_donated`) VALUES('$project_id','$email','$name','$amount')");
  //  print_r($query);die;
  $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

  if ($User_re) {
    echo "<script>alert('Thank you for your Donation');</script>";
    echo "<script>window.location.href='./index.php';</script>";
  } else {
    echo "<script>alert('something went wrong Submitting Donation Detail');</script>";
  }
}
if (isset($_POST['send'])) {
  $name = mysqli_real_escape_string($usman_ngo, $_POST['name']);
  $email = mysqli_real_escape_string($usman_ngo, $_POST['email']);
  $msg = mysqli_real_escape_string($usman_ngo, $_POST['msg']);

  // echo $project_id; die;
  // form validation: ensure that the form is correctly filled ...
  if (empty($_POST['email']) || empty($_POST['name']) || empty($_POST['msg'])) {
    echo "<script>alert('Fill All Fields');</script>";
    echo "<script>window.location.href='./index.php';</script>";
  }


  $query = sprintf("INSERT INTO `volunteer`(`name`, `email`, `msg`) VALUES ('$name','$email','$msg')");
  //  print_r($query);die;
  $User_re = mysqli_query($usman_ngo, $query) or die(mysqli_error($usman_ngo));

  if ($User_re) {



    $mail = new PHPMailer(true);
    try {

      //Server settings
      $mail->SMTPDebug = 1;
      $mail->isSMTP();
      $mail->Host       = 'sandbox.smtp.mailtrap.io';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'a3d7643a5e2648';
      $mail->Password   = '7a57e1373e5d6b';
      $mail->Port       = 2525;

      //Recipients
      $mail->setFrom('support@usmanNGO.com', 'Mailer');
      $mail->addAddress($email, $name);


      //Attachments
      // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      $body = '<p> <strong>' . $name . ' </strong> ' . $msg . '</p>';

      //Content
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $mail->Body    = $body;
      $mail->AltBody = strip_tags($body);


      // Send email
      if ($mail->send()) {
        echo "<script>alert('Thank you for Volunteering');</script>";
        echo "<script>window.location.href='./index.php';</script>";
      } else {
        echo "<script>alert('Fail to Sent Message');</script>";
        echo "<script>window.location.href='./index.php';</script>";
      }
      // print_r('Message has been sent');
    } catch (Exception $e) {
      // print_r("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }
  } else {
    echo "<script>alert('Connection Failed');</script>";
  echo "<script>window.location.href='./index.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Welfare-Index</title>
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
      <a class="navbar-brand" href="index.html">Welfare</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> Menu
      </button>

      <div class="collapse navbar-collapse" id="ftco-nav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
          <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
          <li class="nav-item"><a href="donate.php" class="nav-link">Donations</a></li>
          <li class="nav-item"><a href="blog.php" class="nav-link">Blog</a></li>
          <li class="nav-item"><a href="gallery.php" class="nav-link">Gallery</a></li>
          <li class="nav-item"><a href="event.php" class="nav-link">Events</a></li>
          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- END nav -->

  <div class="hero-wrap" style="background-image: url('images/bg_7.jpg');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
        <div class="col-md-7 ftco-animate text-center" data-scrollax=" properties: { translateY: '70%' }">
          <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Doing Nothing is Not An
            Option of Our Life</h1>

          <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><a href="https://vimeo.com/45830194" class="btn btn-white btn-outline-white px-4 py-3 popup-vimeo"><span class="icon-play mr-2"></span>Watch
              Video</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->


  <section class="ftco-counter ftco-intro" id="section-counter">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-md-5 d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-1 align-items-stretch">
            <?php
            $faculty = $usman_ngo->query("SELECT * FROM services ");
            $row = $faculty->fetch_array();
            ?>
            <div class="text">
              <span>Served Over</span>
              <strong class="number" data-number="<?php echo $row['people_number'] ?>">0</strong>
              <span>Children in Nigeria</span>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-2 align-items-stretch">
            <div class="text">
              <h3 class="mb-4">Donate Money</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts.</p>
              <p><a href="#" data-toggle="modal" data-target="#exampleModal1" class="btn btn-white px-3 py-2 mt-2">Donate Now</a></p>
            </div>
          </div>
        </div>
        <div class="col-md d-flex justify-content-center counter-wrap ftco-animate">
          <div class="block-18 color-3 align-items-stretch">
            <div class="text">
              <h3 class="mb-4">Be a Volunteer</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts.</p>
              <!-- Button trigger modal -->
              <p><a href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-white px-3 py-2 mt-2">Be A Volunteer</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>




  <section class="ftco-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 d-flex services p-3 py-4 d-block">
            <div class="icon d-flex mb-3"><span class="flaticon-donation-1"></span></div>
            <div class="media-body pl-4">
              <h3 class="heading">Make Donation</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 d-flex services p-3 py-4 d-block">
            <div class="icon d-flex mb-3"><span class="flaticon-charity"></span></div>
            <div class="media-body pl-4">
              <h3 class="heading">Become A Volunteer</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 d-flex services p-3 py-4 d-block">
            <div class="icon d-flex mb-3"><span class="flaticon-donation"></span></div>
            <div class="media-body pl-4">
              <h3 class="heading">Sponsorship</h3>
              <p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <section class="ftco-section bg-light">
    <div class="container-fluid">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-5 heading-section ftco-animate text-center">
          <h2 class="mb-4">Our Programs</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind texts.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 ftco-animate">

          <div class="carousel-cause owl-carousel">
            <?php
            $projects = $usman_ngo->query("SELECT * FROM projects");
            while ($row = $projects->fetch_array()) :
              $date =  ucwords($row['updated_at']);
              $string =  ucwords($row['description']);

              $string = strip_tags($string);
              if (strlen($string) > 50) {
                $stringCut = substr($string, 0, 50);
                $endPoint = strrpos($stringCut, ' ');
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                $string .= '... <a href="./donate-single.php?projectid=' . ucwords($row["id"]) . '">Read More</a>';
              }
            ?>
              <div class="item">

                <div class="cause-entry">

                  <a href="./donate-single.php?projectid=<?php echo ucwords($row["id"]); ?>" class="img" style="background-image: url(./images/<?php echo ($row['img']) ?>);"></a>
                  <div class="text p-3 p-md-4">
                    <h3><a href="./donate-single.php?projectid=<?php echo ucwords($row["id"]); ?>"><?php echo ucwords($row['header']) ?></a></h3>
                    <p><?php echo $string; ?></p>
                    <span class="donation-time mb-3 d-block">Last donation <?php echo  date('Y-m-d', strtotime($date));  ?></span>
                    <div class="progress custom-progress-success">
                      <div class="progress-bar bg-primary" role="progressbar" style="width: 28%" aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <span class="fund-raised d-block">&#x20A6;<?php echo ucwords($row['total_donation']) ?> raised of &#x20A6;<?php echo ucwords($row['amount_donated']) ?></span>
                  </div>
                </div>

              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center">
          <h2 class="mb-4">Latest Donations</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind texts.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
          <div class="staff">
            <div class="d-flex mb-4">
              <div class="img" style="background-image: url(images/person_1.jpg);"></div>
              <div class="info ml-4">
                <h3><a href="teacher-single.html">Ivan Jacobson</a></h3>
                <span class="position">Donated Just now</span>
                <div class="text">
                  <p>Donated <span>$300</span> for <a href="#">Children Needs Food</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
          <div class="staff">
            <div class="d-flex mb-4">
              <div class="img" style="background-image: url(images/person_2.jpg);"></div>
              <div class="info ml-4">
                <h3><a href="teacher-single.html">Ivan Jacobson</a></h3>
                <span class="position">Donated Just now</span>
                <div class="text">
                  <p>Donated <span>$150</span> for <a href="#">Children Needs Food</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 d-flex mb-sm-4 ftco-animate">
          <div class="staff">
            <div class="d-flex mb-4">
              <div class="img" style="background-image: url(images/person_3.jpg);"></div>
              <div class="info ml-4">
                <h3><a href="teacher-single.html">Ivan Jacobson</a></h3>
                <span class="position">Donated Just now</span>
                <div class="text">
                  <p>Donated <span>$250</span> for <a href="#">Children Needs Food</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->

  <section class="ftco-gallery">
    <div class="container">

      <div class="row">
        <?php
        $projects = $usman_ngo->query("SELECT * FROM gallery");
        while ($row = $projects->fetch_array()) :
        ?>
          <div class="col-md-3">
            <img src="images/<?php echo $row['filename'] ?>" alt="" width="300px" height="300px" srcset="">
          </div>
        <?php endwhile; ?>
      </div>
    </div>
    </div>
  </section>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center">
          <h2 class="mb-4">Recent from blog</h2>
          <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the
            blind texts.</p>
        </div>
      </div>
      <div class="row d-flex">

        <?php
        $projects = $usman_ngo->query("SELECT * FROM blog LIMIT 3");
        while ($row = $projects->fetch_array()) :
          $date =  ucwords($row['updated_at']);
          $string =  ucwords($row['description']);

          $string = strip_tags($string);
          if (strlen($string) > 50) {
            $stringCut = substr($string, 0, 50);
            $endPoint = strrpos($stringCut, ' ');
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '... <a href="./blog-single.php?blogid=' . ucwords($row["id"]) . '">Read More</a>';
          }
        ?>

          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">
              <a href="./blog-single.php?blogid=<?php echo ucwords($row["id"]); ?>" class="block-20" style="background-image: url(./images/<?php echo ($row['image']) ?>);">
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">

                  <div><a href="./blog-single.php?blogid=<?php echo ucwords($row["id"]); ?>"><?php echo  date('Y-m-d', strtotime($date));  ?></a></div>
                  <div><a href="./blog-single.php?blogid=<?php echo ucwords($row["id"]); ?>"><?php echo ucwords($row['author']) ?></a></div>
                  <div><a href="./blog-single.php?blogid=<?php echo ucwords($row["id"]); ?>" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mt-3"><a href="./blog-single.php?blogid=<?php echo ucwords($row["id"]); ?>"><?php echo ucwords($row['header']) ?></a></h3>
                <p><?php echo $string; ?></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

      </div>
    </div>
  </section>

  <section class="ftco-section bg-light">
    <div class="container">
      <div class="row justify-content-center mb-5 pb-3">
        <div class="col-md-7 heading-section ftco-animate text-center">
          <h2 class="mb-4">Our Latest Events</h2>
        </div>
      </div>
      <div class="row">

        <?php
        $projects = $usman_ngo->query("SELECT * FROM event2 LIMIT 3");
        while ($row = $projects->fetch_array()) :
          $date =  ucwords($row['updated_at']);
          $string =  ucwords($row['description']);

          $string = strip_tags($string);
          if (strlen($string) > 50) {
            $stringCut = substr($string, 0, 50);
            $endPoint = strrpos($stringCut, ' ');
            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '... <a href="./event-single.php?eventid=' . ucwords($row["id"]) . '">Read More</a>';
          }

        ?>

          <div class="col-md-4 d-flex ftco-animate">
            <div class="blog-entry align-self-stretch">

              <a href="./event-single.php?eventid=<?php echo ucwords($row["id"]); ?>" class="block-20" style="background-image: url(./images/<?php echo ($row['image']) ?>);">
              </a>
              <div class="text p-4 d-block">
                <div class="meta mb-3">
                  <div><a href="./event-single.php?eventid=<?php echo ucwords($row["id"]); ?>"></a><?php echo ucwords($row['date']) ?></div>
                  <div><a href="./event-single.php?eventid=<?php echo ucwords($row["id"]); ?>"><?php echo ucwords($row['organizer']) ?></a></div>
                  <div><a href="./event-single.php?eventid=<?php echo ucwords($row["id"]); ?>" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                </div>
                <h3 class="heading mb-4"><a href="./event-single.php?eventid=<?php echo ucwords($row["id"]); ?>"><?php echo ucwords($row['header']) ?></a></h3>
                <p class="time-loc"><span class="mr-2"><i class="icon-clock-o"></i><?php echo ucwords($row['time_from']) ?>-<?php echo ucwords($row['time_to']) ?></span> <span><i class="icon-map-o"></i><?php echo ucwords($row['location']) ?></span></p>
                <p><?php echo $string; ?></p>
                <p><a href="event.php">Join Event <i class="ion-ios-arrow-forward"></i></a></p>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>

  <section class="ftco-section-3 img" style="background-image: url(images/bg_3.jpg);">
    <div class="overlay"></div>
    <div class="container">
      <div class="row d-md-flex">
        <div class="col-md-6 d-flex ftco-animate">
          <div class="img img-2 align-self-stretch" style="background-image: url(images/bg_4.jpg);"></div>
        </div>
        <div class="col-md-6 volunteer pl-md-5 ftco-animate">
          <h3 class="mb-3">Be a volunteer</h3>
          <form action="#" method="post" class="volunter-form">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Your Name">
            </div>
            <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Your Email">
            </div>
            <div class="form-group">
              <textarea name="msg" id="" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
              <input type="submit" value="Send Message" name="send" class="btn btn-white py-3 px-5">
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  <footer class="ftco-footer ftco-section img">
    <div class="overlay"></div>
    <div class="container">
      <div class="row mb-5">
        <div class="col-md-3">
          <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">About Us</h2>
            <?php
            $faculty = $usman_ngo->query("SELECT * FROM about_us ");
            $row = $faculty->fetch_array();
            $string =  ucwords($row['content']);

            $string = strip_tags($string);
            if (strlen($string) > 150) {
              $stringCut = substr($string, 0, 150);
              $endPoint = strrpos($stringCut, ' ');
              $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
              $string .= '... <a href="about.php">Read More</a>';
            }
            ?>
            <p><?php echo $string ?></p>
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

            <?php
            $projects = $usman_ngo->query("SELECT * FROM blog  ORDER BY id DESC LIMIT 2 ");
            while ($row = $projects->fetch_array()) :
              $date =  ucwords($row['updated_at']);

            ?>


              <div class="block-21 mb-4 d-flex">
                <a class="blog-img mr-4" style="background-image: url(images/<?php echo ($row['image']) ?>);"></a>
                <div class="text">
                  <h3 class="heading"><a href="./blog-single.php?blogid=' . ucwords($row[" id"]) . '"><?php echo ucwords($row['header']) ?></a></h3>
                <div class="meta">
                  <div><a href="./blog-single.php?blogid=' . ucwords($row["id"]) . '"><span class="icon-calendar"></span><?php echo  date('Y-m-d', strtotime($date));  ?></a></div>
                  <div><a href="./blog-single.php?blogid=' . ucwords($row["id"]) . '"><span class="icon-person"></span> <?php echo ucwords($row['author']) ?></a></div>
                  <div><a href="./blog-single.php?blogid=' . ucwords($row["id"]) . '"><span class="icon-chat"></span> 19</a></div>
                </div>
              </div>
            </div>

            <?php endwhile; ?>
          
          </div>
        </div>
        <div class="col-md-2">
          <div class="ftco-footer-widget mb-4 ml-md-4">
            <h2 class="ftco-heading-2">Site Links</h2>
            <ul class="list-unstyled">
              <li><a href="#" class="py-2 d-block">Home</a></li>
              <li><a href="#" class="py-2 d-block">About</a></li>
              <li><a href="#" class="py-2 d-block">Donations</a></li>
              <li><a href="#" class="py-2 d-block">project</a></li>
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
                <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San
                    Francisco, California, USA</span></li>
                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                <li><a href="#"><span class="icon icon-envelope"></span><span
                      class="text">info@yourdomain.com</span></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">

          <p>
            <!-- Link back to Colorlib can' t be removed. Template is licensed under CC BY 3.0. -->
                      Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                      </script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by
                      <a href="https://colorlib.com" target="_blank">Colorlib</a>
                      <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                      </p>
                </div>
              </div>
          </div>
  </footer>

  <!-- Modal donate-->
  <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Donate to N.G.O</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3 class="mb-3 text-dark text-center">Account Details</h3>
          <h5><a class="text-dark" href="#"><span>Bank Name: </span> First Bank</h5>
          <h5><a class="text-dark" href="#"><span>Account Number: </span> 2098767845</h5>
          <h5><a class="text-dark" href="#"><span>Account Name: </span>John Doe</h5>
          <hr>
          <div class="mt-3">
            <p class="lead text-center">Your details <span><small>(optional)</small> </span></p>
            <div class="form-group">
              <form action="#" method="post">
                <input type="hidden" name="project_id" value="0">
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

      </div>
    </div>
  </div>
  <!-- Modal -->



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
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
  </script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

</body>

</html>