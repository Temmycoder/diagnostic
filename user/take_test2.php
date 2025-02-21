<?php
  include("../includes/config.php");
  
  if(!isset($_SESSION['id'])){
    header('Location:../index.php');
  }
  $user_id = $_SESSION['id'];
  $test_session_id = uniqid('usr_session_');
  $result = mysqli_query($conn, "SELECT * FROM questions_tbl");
  $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);
  $total_questions = count($questions);


  // $time = date('h:i:s y-m-d');

  if(isset($_GET['page'])){
    $page = (int)$_GET['page'];
  }else{
    $page = 1;
  }

  $question_per_page = 1;

  if(isset($questions[$page - 1])){
    $current_question = $questions[$page - 1];

  }else{
    $current_question = null;
  }

  //$_SESSION['categories'][$current_question['question_id']] = $current_question['category'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer']) && isset($_POST['question_id']) && isset($_POST['category']) ){
    $_SESSION['answers'] [$_POST['question_id']] = $_POST['answer']; // Save answer in session
    $_SESSION['categories'][$_POST['question_id']] = $_POST['category']; // Save category in session

    if ($page < $total_questions) {
      header('Location: take_test2.php?page=' . ($page + 1)); // Redirect to next question
      exit(); // Stop script execution after redirection
    }else {

      // Save responses to DB at the end of the test
      foreach ($_SESSION['answers'] as $question_id => $answer){
        $category = $_SESSION['categories'][$question_id]; // Retrieve the category from the session

        $insert = mysqli_query($conn, "INSERT INTO user_responses_tbl (user_id, category, test_session_id, question_id, answer)
        VALUES('$user_id', '$category', '$test_session_id', '$question_id', '$answer')");

        $insert2 = mysqli_query($conn, "INSERT INTO test_sessions_tbl (user_id, session_id)
        VALUES('$user_id', '$test_session_id')");

        header("location: results.php");
      }
    }
  }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Diagnosis</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport"/>
    <link rel="icon" href="../assets/img/kaiadmin/favicon.ico" type="image/x-icon" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

    <style>
      .quest{
        margin: 10px;
        border-top: 40px solid #1A2035;
        border-left: 10px solid #1A2035;
        border-right: 10px solid #1A2035;
        border-bottom: 20px solid #1A2035;
      }
      .log{
        color: blueviolet !important;
        font-size: 22px;
      }
    </style>
  </head>
  
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include("../includes/sidebar.php"); ?>
      <!-- End Sidebar -->

      <div class="main-panel">
      <?php include("../includes/header.php"); ?>

        <div class="container">
          <div class="page-inner quest">
            <div class="row">
               
              <form method="POST">
                <h2><strong>Question <?php echo $page; ?>:</strong></h2> 
                <h2><?php echo $current_question['question_text']; ?></h2>

                <div class="my-3" >
                  <input type="hidden" name="question_id" value="<?php echo $current_question['id']; ?>">
                  <input type="hidden" name="category" value="<?php echo $current_question['category']; ?>">

                  <label class="col-2">
                      <h1><input type="radio" name="answer" value="Yes"
                      <?php 
                        if (isset($_SESSION['answers'][$current_question['id']]) && $_SESSION['answers'][$current_question['id']] === 'Yes') {
                            echo 'checked';
                          }
                      ?>>
                      Yes</h1>
                  </label><br><br>

                  <label>
                      <h1><input type="radio" name="answer" value="No"
                      <?php 
                          if (isset($_SESSION['answers'][$current_question['id']]) && $_SESSION['answers'][$current_question['id']] === 'No') {
                              echo 'checked'; 
                          }
                      ?>>
                      No</h1>
                  </label>
                </div> 

                <br>

                <?php if ($page > 1): ?>
                    <a href="take_test2.php?page=<?php echo $page - 1; ?>" class="btn btn-secondary">Previous</a>
                <?php endif; ?>
                <input type="submit" class="btn btn-primary" value="Next" />

            </form>
            </div>
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