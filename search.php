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

  <title>Products</title>
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
      <h1>Search</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">search</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      
      <div class="row">

        <!-- Recent Sales -->
        <div class="col-12">
          <div class="card recent-sales overflow-auto">

            <div class="card-body">
              <h5 class="card-title">Search results ~ <i><?php echo  $_POST['search']; ?></i></h5>

              <?php
                  $id = $_SESSION['userId'];

                  $day = date('d');
                  $month = date('m');
                  $year = date('Y');

                  $today = $year."-".$month."-".$day;
                  $sel=null;
                  if (isset($_POST['search'])) {
                    $search = $_POST['search'];
                    $sel = mysqli_query($con, "SELECT * FROM  products  WHERE prod_name like '%$search%'");
                  }
                  else{
                    header("location:index.php");
                  }
                  ?>
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
                    <?php
                      if ($row['vendor_id'] == $id) {
                        
                    ?>
                    <td>
                      <a href="editprod.php?id=<?php echo $row['ProductID']?>" class="badge bg-primary">Edit</a>
                      <a href="deleteprod.php?id=<?php echo $row['ProductID']?>" class="badge bg-danger">Delete</a>
                    </td>
                    <?php
                      }
                      else{
                        ?>
                        <td>
                      <a href="subscribe.php?id=<?php echo $row['ProductID']?>" class="btn btn-success">Subscribe</a>
                    </td>
                        <?php
                      }
                    ?>

                  </tr>
                  <?php
                    }
                  ?>
                  
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