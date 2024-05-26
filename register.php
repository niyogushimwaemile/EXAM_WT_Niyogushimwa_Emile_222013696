<?php
  session_start();
  include 'db.php';

  if (isset($_POST['submit'])) {

   
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $company = $_POST['company'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $target_dir = "assets/img/users";
    $target_file = $target_dir.basename($_FILES['photo']['name']);
    $uploadOk = 1;
    $imageType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['photo']['tmp_name']);
    if ($check !== false) {
      $uploadOk=1;
    }
    else{
      $uploadOk = 0;
    }

    if (file_exists($target_file)) {
      $uploadOk = 0;
    }
    if ($imageType != "jpg" && $imageType != "png" && $imageType != "jpeg" && $imageType != "gif" ) {
      $uploadOk = 0;
    }

    //upload
    if ($uploadOk == 0) {
      echo "File error";
    }
    else {
      if(move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)){
         $insert = mysqli_query($con, "INSERT INTO vendors VALUES(null, '$fname','$lname', '$phone','$company','$address', '$email','$password',current_timestamp(), 'vendor', '$target_file')");

          if ($insert) {
            header("location: login.php");
          }
      }
    }
    
   

  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Registration</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
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
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
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

 <main id="main" class="main">

    
    <section class="section">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Register</h5>

              <!-- Floating Labels Form -->
              <form class="row g-1" action="" method="POST" enctype="multipart/form-data">
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingfName" placeholder="First Name" required name="fname">
                    <label for="floatingfName">First Name</label>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatinglName" placeholder="Last Name" required name="lname">
                    <label for="floatinglName">Last Name</label>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingP" placeholder="Phone number" required name="phone">
                    <label for="floatingP">Phone</label>
                  </div>
                </div>
                

                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingc" placeholder="Company Name" required name="company">
                    <label for="floatingc">Company</label>
                  </div>
                </div>
                

                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatinga" placeholder="Address" required name="address">
                    <label for="floatinga">Address</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="email" class="form-control" id="floatinge" placeholder="email" required name="email">
                    <label for="floatinge">email</label>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="password" class="form-control" id="floatingpwd" placeholder="Password" required name="password">
                    <label for="floatingpwd">Password</label>
                  </div>
                </div>
                

                <div class="col-md-12 mt-2">
                  
                  <input type="file" class="form-control" id="floatingCity" placeholder="" name="photo" onchange="document.getElementById('pic').innerHTML=this.value" style="display: none;" required>
                  <button class="btn w-100 btn-outline-info" type="button" onclick="photo.click()" id="pic">Choose a photo</button>
                </div>
                
                

                <div class="text-center mt-2">
                  <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

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