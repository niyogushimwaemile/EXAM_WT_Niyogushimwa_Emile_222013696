
<?php
  include "db.php";
  session_start();
  $i = $_GET['id'];
  $sel = mysqli_query($con, "SELECT * FROM products JOIN vendors ON products.vendor_id=vendors.VendorID WHERE ProductID=$i");
  $row = mysqli_fetch_array($sel);

  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $starting = $_POST['starting'];
    $ending = $_POST['ending'];

    $select = mysqli_query($con, "SELECT * FROM customer WHERE email='$email'");
    $date = date("Y-m-d HH:mm:ss");
    if (mysqli_num_rows($select) >= 1) {
        $row = mysqli_fetch_array($select);
        $id = $row['CustomerID'];
        $n = $row['prod_name'];
        $d = $row['products.vendor_id'];
        $user = mysqli_query($con, "INSERT INTO subscriptions VALUES(NULL, $id, $i,'$starting','$ending','Approved')");
        if ($user) {
          mysqli_query($con, "INSERT INTO `activities` (`id`, `clientId`, `description`, `date`, `vendorID`) VALUES (NULL, '$id', 'subscribed on $n', current_timestamp(), $i);");
          
            header("location: index.php");
         }
    }
    else {
      $user = mysqli_query($con, "INSERT INTO customer (email, registerDate) VALUES('$email', current_timestamp())");
      if ($user) {
        $select = mysqli_query($con, "SELECT * FROM customer WHERE email='$email'");
        $row = mysqli_fetch_array($select);
        $id = $row['CustomerID'];
        $d = $row['VendorID'];
         $o = mysqli_query($con, "INSERT INTO subscriptions VALUES(NULL, $id, $i,'$starting','$ending','Approved')");
         if ($o) {
          mysqli_query($con, "INSERT INTO `activities` (`id`, `clientId`, `description`, `date`, `vendorID`) VALUES (NULL, $id, 'subscribed on $n', current_timestamp(), $d ");
            header("location: index.php");
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

  <title>SubscriptionBox</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
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


  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              
              <div class="card mb-4 mt-5">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Subscribe</h5>
                    <p class="text-center"><b>
                      <img class="rounded-circle shadow" width="150" height="150" src=<?php echo $row['photo'] ?>><br>
                      <?php
                        echo $row['prod_name'];
                      ?>
                    </b></p>
                  </div>

                  <div class="card-text mb-4">
                    <i class=" d-block text-secondary small">Description:</i>
                    <?php
                      echo $row["description"];
                    ?>
                  </div>

                  <div class="card-text mb-4">
                    <i class=" d-block text-secondary small">Price:</i>
                    <?php
                      echo number_format($row["price"]);
                    ?> RWF
                  </div>
                  <div class="card-text mb-4">
                    <i class=" d-block text-secondary small">Vendor:</i>
                    <?php
                    
                      echo $row["firstname"]." ".$row["lastname"];
                    ?> 
                  </div>

                 
                  <hr>
                  <h5>Subscribe here</h5>
                  <form class="row g-3 needs-validation" novalidate action="" method="POST">

                    <div class="col-12">
                     
                      <div class="input-group has-validation">
                        
                        <input type="email" name="email" class="form-control shadow" id="" required placeholder="Enter your email to subscribe" value="<?php 
                          
                          if(isset($_SESSION['email'])) echo $_SESSION['email'];
                      ?>" >
                        <div class="invalid-feedback">Please enter your email .</div>
                      </div>

                      <div class="row mt-1 g-1">
                        <div class="col-md-6">
                          <label for="starting">Starting</label>
                           <div class="input-group has-validation">
                        
                        <input type="date" name="starting" class="form-control shadow" id="starting" required placeholder="Choose starting date" value="<?php 
                          
                          echo date("Y-m-d");
                      ?>" >
                        <div class="invalid-feedback">Please choose starting date.</div>
                      </div>
                        </div>
                        <div class="col-md-6">
                          <label for="ending">Ending</label>
                           <div class="input-group has-validation">
                        
                        <input type="date" name="ending" class="form-control shadow" id="ending" required placeholder="choose ending date">
                        <div class="invalid-feedback">Please choose ending date.</div>
                      </div>
                        </div>
                      </div>
                    </div>

                  
                    <div class="col-12">
                      <input class="btn btn-primary w-100" type="submit" value="Subscribe" name="submit">
                    </div>
                    <a href="index.php">Back</a>
                  </form>

                </div>
              </div>

              <div class="credits">
               
                Designed by <a href="#">NIYOGUSHIMWA Emile</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
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
