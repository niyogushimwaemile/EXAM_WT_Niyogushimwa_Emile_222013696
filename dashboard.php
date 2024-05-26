<?php
  session_start();
  include 'db.php';
  if (!isset($_SESSION['userId'])) {
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard</title>
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

</head>

<body>

  <!-- ======= Header and Sidebar ======= -->
    <?php
      include "assets/pages/header.php";
      include "assets/pages/sidebar.php";
    ?>
  <!-- End Header ans Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" onclick="getSubscriptions( this.innerHTML, this.innerHTML, 'subs')" style="cursor: pointer;">Today</a></li>
                    <li><a class="dropdown-item" onclick="getSubscriptions( this.innerHTML, this.innerHTML, 'subs')" style="cursor: pointer;">This Month</a></li>
                    <li><a class="dropdown-item" onclick="getSubscriptions( this.innerHTML, this.innerHTML, 'subs')" style="cursor: pointer;">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Subscriptions <span id="title">| Today</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $id = $_SESSION['userId'];

                      $day = date('d');
                      $month = date('m');
                      $year = date('Y');

                      $today = $year."-".$month."-".$day;

                        $sel = mysqli_query($con, "SELECT * FROM subscriptions sub JOIN products prod ON sub.productID=prod.productID WHERE prod.vendor_id=$id AND StartDate='$today' ");
                      ?>
                      <h6 id="subs">
                        <?php 
                        
                          echo(mysqli_num_rows($sel)); 
                        ?>
                          
                        </h6>
                      

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                
                <div class="card-body">
                  <h5 class="card-title">My Products <span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-menu-button-wide"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $sel = mysqli_query($con, "SELECT * FROM products WHERE vendor_id=$id");
                      ?>
                      <h6>
                        <?php 
                        
                          echo(mysqli_num_rows($sel)); 
                        ?>
                      </h6>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Top Selling -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                
                <div class="card-body pb-0">
                  <h5 class="card-title">Top Selling </h5>
                    <?php

                      $sel = mysqli_query($con, "SELECT count(subscriptionID) AS subs, photo, prod_name, price, products.ProductID, vendor_id FROM subscriptions JOIN products ON subscriptions.productID=products.ProductID WHERE products.vendor_id=$id GROUP BY products.ProductID ORDER BY subs DESC LIMIT 3");
                      ?>
                  <table class="table table-striped table-borderless table-hover">
                    <thead>
                      <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Sold</th>
                        <th scope="col">Revenue</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        while ($row = mysqli_fetch_array($sel)) {
                         
                      ?>
                      <tr>
                        <th scope="row"><a href="#"><img src=<?php echo $row['photo'] ?> alt=""></a></th>
                        <td><a href="product.php?id=<?php echo $row['ProductID'] ?>" class="text-primary fw-bold"><?php echo $row['prod_name'] ?></a></td>
                        <td><?php echo number_format($row['price']) ?></td>
                        <td class="fw-bold"><?php echo $row['subs'] ?></td>
                        <td>RWF <?php echo number_format($row['price']*$row['subs']) ?></td>
                      </tr>
                      <?php } ?>

                      
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Top Selling -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <!-- Recent Activity -->
          <div class="card">

            <div class="card-body">
              <h5 class="card-title">Recent Activity</h5>

              <div class="activity">
                <?php
                  $S = mysqli_query($con, "SELECT * FROM activities JOIN customer ON activities.clientId=customer.CustomerID JOIN products ON products.productID=activities.prodID JOIN vendors ON vendors.vendorID=products.vendor_id WHERE vendorID=$id limit 5");
                  while ($r = mysqli_fetch_array($S)) {
                   
                ?>
                <div class="activity-item d-flex overflow-auto">
                  <div class="activite-label">1d<?php //echo $r['date'] ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content">
                    <a href="#" class="fw-bold text-dark"><?php echo $r['email'] ?></a> 
                    <?php echo $r['descriptions']." ".$r['prod_name']; ?>
                  </div>
                </div>
                <?php } ?>
                <a class="float-end" href=""><i>Show more...</i></a>
              </div>

            </div>
          </div><!-- End Recent Activity -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                   
                    <li><a class="dropdown-item" onclick="getCustomers( this.innerHTML, this.innerHTML, 'customers')" style="cursor: pointer;">Today</a></li>
                    <li><a class="dropdown-item" onclick="getCustomers( this.innerHTML, this.innerHTML, 'customers')" style="cursor: pointer;">This Month</a></li>
                    <li><a class="dropdown-item" onclick="getCustomers( this.innerHTML, this.innerHTML, 'customers')" style="cursor: pointer;">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Customers <span id="head">| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <?php
                      $id = $_SESSION['userId'];

                      $day = date('d');
                      $month = date('m');
                      $year = date('Y');

                      $today = $year."-".$month."-".$day;

                        $sel = mysqli_query($con, "SELECT * FROM customer WHERE year(registerDate)='$year' ");
                      ?>
                      <h6 id="custs"> <?php 
                        
                          echo(mysqli_num_rows($sel)); 
                        ?></h6>
                      

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->


        </div><!-- End Right side columns -->

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