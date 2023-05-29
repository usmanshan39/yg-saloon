<?php require_once("./admin/functions/config.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Y-G Saloon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- Owl Stylesheets -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/owlcarousel/assets/owl.theme.default.min.css">

    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/global.css">
</head>

<body>

    <header class="about-us">
        <nav class="global-navbar navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a class="header2-logo" href="./index.html"><img src="./assets/images/logo-black.png" class="img-fluid header-logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <!-- <span class="navbar-toggler-icon"></span> -->
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./index.html">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./about-us.html">About&nbsp;us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./services.html">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./our-portfolio.html">Portfolio</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="./contact-us.html">Contact</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="./blogs.php">Blog</a>
                        </li>
                    </ul>
                    <div class="d-flex align-items-center justify-content-between flex-wrap flex-lg-nowrap">
                        <p class="text-center me-3 me-xl-5 mb-0 header-text">+971 522381623 / 624 / 625<br>Prime Tower –
                            Office #
                            3101, Dubai</p>
                        <button class="btn btn-appointment-header" data-bs-toggle="modal" data-bs-target="#appModal">Appointment</button>
                    </div>
                </div>
            </div>
        </nav>
        <div class="about-banner">
            <div class="col-md-8 m-auto">
                <p class="small-heading1 text-white">HOME / OUR Blogs</p>
                <h1 class="main-heading42">OUR Blogs</h1>
            </div>
        </div>
    </header>


    <section class="blogs-sec1 m-sec-top">
        <div class="container">
            <div class="row">
              <?php
                $sql = "SELECT * FROM our_blogs";
                $result = $conn->query($sql);
                $data = array();
                if ($result) {
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            
                          ?>
                            <div class="col-md-6 col-lg-4 col-xl-4 mt-3">
                            <div class="card">
                                <img class="card-img-top" src="./admin/uploads/<?php echo $row['blog_image'] ?>" alt="Bologna">
                                <div class="card-body">
                                  <h4 class="card-title"><?php echo $row['title'] ?></h4>
                                  <p class="card-text blog-short-p"><?php echo $row['blog_desc'] ?></p>
                                  <a href="blog-details.php?id=<?php echo $row['id'] ?>" class="card-link">Read More</a>
                                </div>
                              </div>
                        </div>
                          <?php
                        }
                    }
                }
               ?>
            </div>
        </div>
    </section>


  <!-- footer section start -->

  <section class="footer m-sec-top">
    <div class="container">
      <div class="col-md-4">
        <img src="assets/images/logo.png" class="footer-logo img-fluid">
      </div>
      <div class="row">
        <div class="border-right col-md-6 col-lg-4 mt-4 pt-4">
          <div class="p-3">
            <p class="text-white">We prioritize hygiene and safety by following all SOPs and regularly disinfecting high-traffic areas to control the spread of diseases. Our use of natural, cruelty-free, vegan, and organic products ensures your health and wellness. Come experience the Y&G Salon difference today!</p>
          </div>
        </div>
        <div class="border-right-2 col-md-6 col-lg-4 mt-4">
          <div class="p-3">
            <p class="text-white">Our Timings</p>
            <p class="text-white mt-3">Mon-Fri: 9 AM – 9 PM</p>
            <p class="text-white">Sat-Sun: 10 AM – 10 PM</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-4 mt-4">
          <div class="p-3">
            <p class="text-white">Get in touch with us</p>
            <p class="text-white"><i class="fa fa-map-marker orange-color"></i> Prime Tower – Office # 3101, Dubai</p>
            <p class="text-white"><i class="fa fa-envelope orange-color"></i> info@ygsalon.ae</p>
            <p class="text-white"><i class="fa fa-phone orange-color"></i> +971 522381623 / 624 / 625</p>
          </div>
        </div>
      </div>
      <div class="row footer-bottom text-center mt-5">
        <p class="text-white py-4">Y&G Salon © 2022 All Rights Reserved.</p>
      </div>
    </div>
  </section>

  <!-- footer section end -->


    <!-- Modal -->
    <div class="modal fade" id="appModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="book-form">
            <p class="small-heading1">Book Appointment</p>
            <h1 class="main-heading42">Today For Free</h1>
            <form class="add-appointment-form">
              <div class="form-group mt-3">
                <input type="text" name="name" class="form-control cus-form-control" placeholder="Your name" required>
              </div>
              <div class="form-group mt-3">
                <input type="email" name="email" class="form-control cus-form-control" placeholder="Email Address" required>
              </div>
              <div class="form-group mt-3">
                <input type="number" name="mobile" class="form-control cus-form-control" placeholder="Mobile Number" required>
              </div>
              <div class="form-group mt-3">
                <input type="date" name="date" class="form-control cus-form-control" required>
              </div>
              <div class="form-group mt-3">
                <input type="time" name="time" class="form-control cus-form-control" required>
              </div>
              <button type="submit" class="btn btn1 form-control mt-3">Make an Appointment</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script src="assets/owlcarousel/owl.carousel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="assets/js/custom/script.js"></script>

</body>

</html>