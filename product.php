<?php
  session_start();
  include 'db.php';
  if (!isset($_SESSION['userId'])) {
    header("location:login.php");
  }
  $i = $_GET['id'];

  $sel = mysqli_query($con, "SELECT * FROM products JOIN vendors ON products.vendor_id = vendors.VendorID WHERE ProductID=$i");
  $row = mysqli_fetch_array($sel);
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
          <li class="breadcrumb-item">Product</li>
          <li class="breadcrumb-item active">View</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

   

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 d-flex flex-column align-items-center justify-content-center">

              
              <div class="card mb-2">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    
                    <p class="text-center"><b>
                      <img class="rounded-circle shadow" width="150" height="150" src=<?php echo $row['photo'] ?>>
                      <h5 class="card-title text-center pb-0 fs-4"><?php
                        echo $row['prod_name'];
                      ?></h5>
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

                 

            </div>
          </div>
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

</body>

</html>
