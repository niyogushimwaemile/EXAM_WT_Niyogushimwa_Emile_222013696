<?php
  session_start();
  include 'db.php';

  $search = $_POST['search'];
  if (!isset($search)) {
    header("location:index.php");
  }
                 
    $sel = mysqli_query($con, "SELECT * FROM  products  WHERE prod_name like '%$search%' OR description like '%$search%'");
                
              
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Subscriptions</title>
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
        <span class="d-none d-lg-block">Search</span>
      </a>
      <!-- <i class="bi bi-list toggle-sidebar-btn"></i> -->
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="search2.php">
        <input type="text" name="search" placeholder="Search" title="Enter search keyword"  required>
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
            $sel2 = mysqli_query($con, "SELECT * FROM vendors WHERE VendorID=$id");
            $data = mysqli_fetch_array($sel2);
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
      <h1>Search</h1>
      
    </div><!-- End Page Title -->

    <section class="section dashboard">
      
      <div class="row">

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            

            <div class="card-body">
              <h5 class="card-title">Search results for ~ <I><?php echo $search ?></I></h5>
                   
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">Preview</th>
                    <th scope="col">Product</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    while ($row = mysqli_fetch_array($sel)) {
                    
                  ?>
                  <tr>
                    <th scope="row"><a href="product.php?id=<?php echo $row['ProductID']?>"><img src=<?php echo $row['photo']?> alt="Photo" width="60" height="60"></a></th>
                    <td><a href="product.php?id=<?php echo $row['ProductID']?>" class="text-primary fw-bold"><?php echo $row['prod_name']?></a></td>
                    <td><?php echo $row['description']?></td>
                    <td><?php echo number_format($row['price'])?> RWF</td>
                    
                        <td>
                      <a href="subscribe.php?id=<?php echo $row['ProductID']?>" class="btn btn-success">Subscribe</a>
                    </td>
                        <?php
                      }
                    ?>

                  </tr>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->

      </div>
   
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
    <?php 
      include "assets/pages/footer.php";
    ?>
  <!-- End Footer -->

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

<script type="text/javascript">

  function getSubscriptions(time, title, type){
    
    let subs = document.getElementById('subs');
    document.getElementById('title').innerHTML = "| "+title;

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
      if (xhr.status === 200) {
        subs.innerHTML = xhr.responseText;

      }
    }

    xhr.open("GET", "getsub.php?time="+time+"&type="+type, true);
    xhr.send();
  }


  function getCustomers(time, title, type){
    
    let custs = document.getElementById('custs');
    document.getElementById('head').innerHTML = "| "+title;

    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
      if (xhr.status === 200) {
        custs.innerHTML = xhr.responseText;

      }
    }

    xhr.open("GET", "getsub.php?time="+time+"&type="+type, true);
    xhr.send();
  }
</script>
</body>

</html>