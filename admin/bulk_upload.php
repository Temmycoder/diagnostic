<?php
  include("../includes/config.php");

  if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
  }

  if(isset($_POST['upload'])){
    $file = $_FILES["csv_file"]["tmp_name"];
    if($file){
      $handle = fopen($file, 'r');
      fgetcsv($handle, 1500, ",");
      
      while(($data = fgetcsv($handle, 1500, ",")) !== false){
        $name = $data[0];
        $username = $data[1];
        $email = $data[2];
        $password = password_hash($data[3], PASSWORD_DEFAULT);
        $phone = $data[4];
        $age = $data[5];
        $gender = $data[6];
        $address = $data[7];
        $role = "admin";

        $insert = mysqli_query($conn, "INSERT INTO users_tbl (name, username, email, password, phone, age, gender, address, role) 
        VALUES ('$name', '$username', '$email', '$password', '$phone', '$age', '$gender', '$address', '$role')");
      }
      fclose($handle);
      $success =  "<div class='alert alert-success'>file uploaded successfully</div>";
    }else{
      echo "file upload failed";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Diagnosis</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="../assets/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include("../includes/sidebar.php"); ?>
      <!-- End Sidebar -->

      <div class="main-panel">
        <?php include("../includes/header.php"); ?>

        <div class="container">
          <div class="page-inner">
            <h2>Upload new admins in bulk</h2>
            <p>click on the download button to download </p>
            <a class="btn btn-warning" href="sample.csv">Download</a>
            <form method="post" enctype="multipart/form-data">
              <div>
                <?php echo $error; echo $success;?>
                <label>Upload File:</label>
                <input type="file" id="csv_file" name="csv_file" class="form-control"><br><br>
                <input type="submit" name="upload" class="btn btn-secondary">
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

    <!-- Chart JS -->
    <script src="../assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="../assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="../assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="../assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="../assets/js/kaiadmin.min.js"></script>

    <script src="../assets/js/setting-demo.js"></script>
    <script src="../assets/js/demo.js"></script>
    <script>
      $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
      });

      $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
      });

      $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
      });
    </script>
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