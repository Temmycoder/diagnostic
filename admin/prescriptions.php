<?php
  include("../includes/config.php");
  
  if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
  }
  if(isset($_POST['submit'])){
    $cat = $_POST['cat'];
    $age = $_POST['age'];
    $drug = $_POST['drug'];
    $instruction = $_POST['instruction'];

    $insert = mysqli_query($conn, "INSERT INTO prescriptions_tbl (category_name, age_range, drug_name, instructions) 
    VALUES('$cat', '$age', '$drug', '$instruction')");
    if($insert){
      $success = "<div class='alert alert-success'>The question has been successfully inserted</div>";
    }else{
      $error = "<div class='alert alert-danger'>The question has not been inserted! try again later</div>";
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Diagnosis</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <style>
    </style>
  </head>
  
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include("../includes/sidebar.php"); ?>
      <!-- End Sidebar -->

      <div class="main-panel">
      <?php include("../includes/header.php"); ?>

        <div class="container ">
        <h1 class="text-center p-4">Add a new Diagnostic Prescription</h1>

          <div class="page-inner">
            <?php echo "$error $success"; ?>
            <form action="" method="post">
              <div class="mb-5 container-fluid">
                <div class="row">
                  <div class="col-md-6">
                    <label><h4>Category:</h4></label>
                    
                    <select class="form-control shadow" name="cat" required>
                      <?php
                        $sql = mysqli_query($conn, "SELECT * FROM category_tbl");
                        while ($result= mysqli_fetch_array($sql)){
                          echo "<option value='$result[1]'>$result[1]</option>";
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label><h4>Drug name:</h4></label>
                    <input type="text" class="form-control shadow" name="drug" required autofocus></input><br>
                  </div>
                </div>

                <div class="row mt-5">
                  <div class="col-md-6">
                    <label><h4>Instructions:</h4></label>
                    <textarea class="form-control shadow" cols="45" rows="9" name="instruction" required></textarea><br>
                  </div>

                  <div class="col-md-6">
                    <label for=""><h4>Age Range:</h4></label>
                    <select name="age" id="" class="form-control shadow" required>
                      <option selected>.....</option>
                      <option value="adult">Adult</option>
                      <option value="children">Children</option>
                    </select>
                  </div>
                </div>

                <div>
                  <input type="submit" name="submit" class="btn btn-primary mt-4"/>
                </div>
              </div>
            </form>
          </div>
        </div>

        <?php include("../includes/footer.php")?>

      </div>

    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <!-- Fonts and icons -->
    <script src="../assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["../assets/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
  </body>
</html>