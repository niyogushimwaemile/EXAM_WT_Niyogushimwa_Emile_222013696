<?php

  include "db.php";

  $getProducts = mysqli_query($con, "SELECT * FROM products JOIN vendors ON products.vendor_id=vendors.VendorID");
  $countProducts = mysqli_num_rows($getProducts);

  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Subscription Box</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style type="text/css">
    #mainn {
      margin-top: 60px;
      padding: 20px 30px;
      transition: all 0.3s;
    }
    .foot {
      padding: 20px 0;
      font-size: 14px;
      transition: all 0.3s;
      border-top: 1px solid #cddfff;
    }

    .foot .copyright {
      text-align: center;
      color: #012970;
    }

    .foot .credits {
      padding-top: 5px;
      text-align: center;
      font-size: 13px;
      color: #012970;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <?php if(isset($_SESSION['userId'])){?>
      <a href="dashboard.php" class="logo d-flex align-items-center">
        <?php
          }
          else{
            ?>
            <a href="index.php" class="logo d-flex align-items-center">
            <?php
          }
        ?>
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Subscription</span>
      </a>
      <!-- <i class="bi bi-list toggle-sidebar-btn"></i> -->
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="search2.php">
        <input type="text" name="search" placeholder="Search" title="Enter search keyword" required>
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown" title="cart">
            <i class="bi bi-cart"></i>
            <span class="badge bg-primary badge-number">0</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You may have some items in cart
              <a href="#"><span class="badge rounded-pill bg-danger p-2 ms-2">Cancel</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Enter email to see your subscriptions</h4>
                <p>
                  <form action="mysubs.php" method="POST">
                   <input type="email" name="email" class="form-control shadow" placeholder="Email" required>

                 
                </p>
              </div>
            </li>

            

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <input type="submit" value="Show my cart" name="submit"  class="form-control btn btn-primary">
            </form>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <?php
          if(isset($_SESSION['userId'])){

            $id = $_SESSION['userId'];
            $sel = mysqli_query($con, "SELECT * FROM vendors WHERE VendorID=$id");
            $data = mysqli_fetch_array($sel);
          ?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src=<?php echo $data['profile']; ?> alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $data['firstname']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?php echo $data['firstname']." ".$data['lastname'];?></h6>
              <span><?php echo $data['company']; ?></span>
            </li>
            
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

            <?php
          }
          else{
        ?>
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle h4"></i>
            <span class="d-none d-md-block dropdown-toggle ps-2">User</span>
          </a><!-- End Profile image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            
            <li>
              <a class="dropdown-item d-flex align-items-center" href="login.php">
                <i class="bi bi-person"></i>
                <span>Login</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="register.php">
                <i class="bi bi-pen"></i>
                <span>Register</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
        <?php } ?>
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->


  <main id="mainn" class="main">

    <div class="pagetitle">
      <h1>Products</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          
          <li class="breadcrumb-item active">Products</li>
        </ol>
      </nav>
    </div>

    <section class="section">
      <div class="row align-items-top gx-3">

        
          <?php 
            if ($countProducts >= 1) {
              
              while ($rows = mysqli_fetch_array($getProducts)) {
          ?>
          <div class="col-lg-3">
            <!-- PRODUCT -->
            <div class="card shadow">
              
              <img src=<?php echo $rows['photo']?> height="200">
               <div class="card-body text-center">
                <h5 class="card-title"><?php echo  $rows["prod_name"]; ?></h5>
                <span class="card-text fw-bold"><?php echo  number_format($rows["price"]); ?> RWF
                </span>
                <div><i class="text-secondary w-100" style="font-size: 12px"><?php echo  $rows["firstname"]." ".$rows["lastname"]; ?></i></div>
                <a href="subscribe.php?id=<?php echo $rows["ProductID"]; ?>" class="btn btn-primary">Subscribe</a>
              </div>
            </div>
          </div>
            <!-- END PRODUCT -->
          <?php
              }
            }
            else {
              echo "<h2><i>No product found </i></h2>";
            }
          ?>

        

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="foot" class="foot">
    <div class="copyright">
      &copy; Copyright <strong><span>SubscriptionBox</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">NIYOGUSHIMWA Emile</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>