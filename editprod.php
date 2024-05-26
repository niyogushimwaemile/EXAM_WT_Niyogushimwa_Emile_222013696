<?php
  session_start();
  include 'db.php';
  if (!isset($_SESSION['userId'])) {
    header("location:login.php");
  }

 

    $i = $_GET['id'];
    $s = mysqli_query($con, "SELECT * FROM products WHERE ProductID=$i");
    $r = mysqli_fetch_array($s);
  
    if (isset($_POST['submit'])) {

      $id = $_SESSION['userId'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $description = $_POST['description'];
      
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
      
        
        $insert = mysqli_query($con, "UPDATE `products` SET `prod_name` = '$name',`description` = '$description', price=$price, photo='$target_file' WHERE `products`.`ProductID` = $i;");
        header("location: myproducts.php");
      }
      else {
        $insert = mysqli_query($con, "UPDATE `products` SET `prod_name` = '$name',`description` = '$description', price=$price WHERE `products`.`ProductID` = $i;");
        header("location: myproducts.php");
      }
    }


      
      
    }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Edit Product</title>
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

  <!-- ======= Header and Sidebar ======= -->
    <?php
      include "assets/pages/header.php";
      include "assets/pages/sidebar.php";
    ?>
  <!-- End Header ans Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Product</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Products</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-7">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Edit Product</h5>

              <!-- Floating Labels Form -->
              <form class="row g-3" action="" method="POST" enctype="multipart/form-data">
                <div class="col-md-12 text-center">
                  <img src=<?php echo $r['photo'] ?> width="150"  alt="Photo" class="rounded-circle shadow">
                  <input type="file" class="form-control" id="floatingCity" placeholder="" name="photo" onchange="document.getElementById('pic').innerHTML=this.value" style="display: none;"><br>
                  <button class="btn btn-sm btn-outline-info" type="button" onclick="photo.click()" id="pic">Edit photo</button>
                </div>
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="text" class="form-control" id="floatingName" placeholder="Your Name" required name="name" value="<?php echo $r['prod_name'] ?>">
                    <label for="floatingName">Product Name</label>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-floating">
                    <input type="number" class="form-control" id="floatingName" placeholder="Price" required name="price"  value="<?php echo $r['price'] ?>">
                    <label for="floatingName">Price</label>
                  </div>
                </div>
                


                <div class="col-12">
                  <div class="form-floating">
                    <input class="form-control" placeholder="Address" id="floatingTextarea" style="height: 100px;" required name="description" value="<?php echo $r['description'] ?>">
                    <label for="floatingTextarea">Description</label>
                  </div>
                </div>
                <div class="col-md-12">
                  
                  
                </div>
                
                

                <div class="text-center">
                  <input type="submit" class="btn btn-primary" value="Save Changes" name="submit">
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form><!-- End floating Labels Form -->

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