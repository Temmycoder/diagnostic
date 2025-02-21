<?php
  include("../includes/config.php");
  
  if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
  }
  $user_id = $_SESSION['id'];
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
          <h1 class="text-center p-4">All Test History</h1>

          <div class="page-inner">
            <table class="table table-responsive table-hover table-striped">
              <tr>
                <td>ID</td>
                <td>Diagnosis</td>
                <td>Percentage</td>
                <td>Test Time</td>
                <td>View All</td>
              </tr>
              <?php
                $sql = mysqli_query($conn, "SELECT * FROM diagnoses_tbl WHERE user_id = '$user_id'");
                $i = 1;
                while ($result = mysqli_fetch_assoc($sql)){
                  $_SESSION['test_id'] = $result['test_session_id'];
                  echo "
                  <tr>
                    <td>$i</td>
                    <td>". ucfirst($result['diagnosis']) ."</td>
                    <td>$result[diagnosis_percent]%</td>
                    <td>$result[created_at]</td>
                    <td><a class='btn btn-warning p-2 m-0' href='test_responses_history.php?test=$result[test_session_id]'>View all stats</a></td>
                  </tr>";
                  $i++;
                }
              ?>
            </table>
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