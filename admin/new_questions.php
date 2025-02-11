<?php
  include("../includes/config.php");
  
  if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
  }
  if(isset($_POST['submit'])){
    $cat = $_POST['cat'];
    $text = $_POST['texts'];

    $results = mysqli_query($conn, "SELECT * FROM category_tbl WHERE cat_name = '$cat'");
    if (mysqli_num_rows($results) < 1) {
      $error = "<div class='alert alert-danger'>The disease category does not exist</div>";
    }else{
      $insert = mysqli_query($conn, "INSERT INTO questions_tbl (category, question_text) VALUES('$cat', '$text')");
      if($insert){
        $success = "<div class='alert alert-success'>The question has been successfully inserted</div>";
      }
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

        <div class="container bg-white">
        <h1 class="text-center p-4">Add a new Diagnostic question</h1>

          <div class="page-inner">
            <?php echo "$error $success"; ?>
            <form action="" method="post">
                <div class="mb-5 container-fluid">
                  <div class="">
                    <div class="col-5">
                      <label><h4>Category:</h4></label>
                      
                      <select class="form-control" name="cat">
                        <?php
                          $sql = mysqli_query($conn, "SELECT * FROM category_tbl");
                          while ($result= mysqli_fetch_array($sql)){
                            echo "<option value='$result[1]'>$result[1]</option>";
                          }
                        ?>
                      </select>
                    </div><br>

                    <div class="col-5">
                      <label><h4>Question:</h4></label>
                      <textarea class="form-control" cols="45" rows="9" name="texts" required autofocus></textarea><br>
                      <input type="submit" name="submit" class="btn btn-primary mt-4"/>
                    </div>
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