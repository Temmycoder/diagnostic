<?php
  include("../includes/config.php");
  
  if(!isset($_SESSION['id'])){
    header('Location: ../index.php');
  }
  $user_id = $_SESSION['id'];
  $test_id = $_SESSION['test_id'];
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
          <h1 class="text-center p-4">Test Stats</h1>

          <div class="page-inner">
            <table class="table table-responsive table-hover table-striped">
              <tr>
                <td>ID<td>
                <td>Category<td>
                <td>Question<td>
                <td>Answer<td>
              </tr>
              <?php
                $sql = mysqli_query($conn, "SELECT user_responses_tbl.category, user_responses_tbl.answer, 
                questions_tbl.question_text FROM user_responses_tbl JOIN questions_tbl ON user_responses_tbl.question_id = questions_tbl.id
                 WHERE user_responses_tbl.user_id = '$user_id' AND user_responses_tbl.test_session_id = '$test_id'");
                $i = 1;
                while ($result = mysqli_fetch_assoc($sql)){

                  echo "
                  <tr>
                    <a href='test_responses_history.php'>
                      <td>$i<td>
                      <td>" . ucfirst($result['category']) ."<td>
                      <td>$result[question_text]<td>
                      <td>$result[answer]<td>
                    </a>
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