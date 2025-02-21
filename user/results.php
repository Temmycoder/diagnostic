<?php
  include("../includes/config.php");

  if(!isset($_SESSION['id'])){
    header('Location:../index.php');
  }
  $test_id = $_SESSION['test_session_id'];
  $user_id = $_SESSION['id'];
  $age = $_SESSION['age'];
  $answer = $_SESSION['answers'];
  $csrf_token = $_SESSION['csrf_token'];

  //echo $test_session_id;
  // SQL query
  $sql = "SELECT q.category, SUM(CASE WHEN ur.answer = 'yes' THEN 1 ELSE 0 END) AS yes_count, 
    COUNT(q.id) AS total_questions FROM user_responses_tbl ur JOIN questions_tbl q ON ur.question_id = q.id
    WHERE ur.user_id = '$user_id' AND ur.test_session_id='$test_id' GROUP BY q.category ORDER BY yes_count DESC";

  $result = mysqli_query($conn, $sql);
  $diagnosis = [];
  $highest_score = 0;
  $possible_disease = [];
  $percentage_score = 0;
        
  if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
      $category = $row['category'];
      $yes_count = $row['yes_count'];
      $total_questions = $row['total_questions'];

      // calculate score percentage
      $percentage_score = ($total_questions > 0) ? ($yes_count / $total_questions) * 100 : 0;
      // stores the percentage in diagnosis array
      $diagnosis [$category] = number_format($percentage_score, 2); 

      if($percentage_score > $highest_score){
        $highest_score = $percentage_score;
      }
    }
  } else {
      echo "Error: " . mysqli_error($conn);
  }

  $strong_threshold = 75;
  $possible_threshold = 50;
  

  foreach ($diagnosis as $disease => $score){
     if ($score >= $strong_threshold){
       $possible_disease[] = $disease;
       $possible_perc[] = $score;

    }
  }

  $poss_dis = implode($possible_disease);
  $poss_perc1 = implode($possible_perc);
  $poss_perc = intval($poss_perc1);
  $csrf_token_check = mysqli_query($conn, "SELECT id FROM diagnoses_tbl WHERE user_id = $user_id AND csrf_token = '$csrf_token'");
  $csrf_result = mysqli_num_rows($csrf_token_check);
  if($csrf_result < 1) {
    $insert = mysqli_query($conn, "INSERT INTO diagnoses_tbl (user_id, test_session_id, diagnosis, diagnosis_percent, csrf_token) 
    VALUES ('$user_id', '$test_id', '$poss_dis', '$poss_perc', '$csrf_token')");
  }else{
    header("Location: take_test.php");
  }
 
  if($age < 19){
    $age_range = "chidren";
  }else{
    $age_range = "adult";
  }

  $prescription = mysqli_query($conn, "SELECT * FROM prescriptions_tbl WHERE category_name = '$poss_dis' 
  AND age_range = '$age_range'");
  $prescription_result = mysqli_fetch_assoc($prescription);

  if($prescription_result){
    $prescription_drug = $prescription_result['drug_name'];
    $prescription_instructions = $prescription_result['instructions'];
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
      .log{
        color: blueviolet !important;
        font-size: 22px;
      }
    </style>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include("../includes/sidebar.php"); ?>
      <!-- End Sidebar -->

      <div class="main-panel">
      <?php include("../includes/header.php"); ?>


        <div class="container">
          <div class="page-inner quest">
            
            <div class="row">
              <h2>Confidence score for each disease based on your responses</h2>
              <ol>
              <?php 
              
                foreach($diagnosis as $disease => $percentage_score){
                  echo "<li>". ucfirst ($disease).": ".  $percentage_score ."%</li>";
                  echo "<hr/>";
                }
                  // echo "<p>Category: $category</p>";
                  // echo "<p>Yes Count: $yes_count</p>";
                  // echo "<p>Total Questions: $total_questions</p>";
                  // echo "<p>Percentage Score: " . number_format($percentage_score, 2) . "%</p>";
                  // echo "<hr>";
                  
              ?>
              <?php

                if(!empty($possible_disease)){
                  echo"<h3 class='text-uppercase mt-5'>diagnostic result</h3>";
                  echo"<h4 class=''>You may have <span class='text-uppercase text-primary'>". implode(" / ", $possible_disease )."</span>
                  kindly see a doctor for additonal checkups. </h4>";
                }else{
                  echo"No strong evidence of infection stay safe, please see a doctor if the symptoms persists.";
                };
                
                ?><br>
                <?php
                  

                  if(!empty($prescription_result)){
                    echo "<h3 class='text-uppercase mt-5'>Prescriptions</h3>";
                    echo "<h4>Drug Name: " . $prescription_drug ."</h4>";
                    echo "<h4>Usage Instructions: " . $prescription_instructions ."</h4>";
                  }else{
                    echo "<h4>Based on your responses we could not specify your ailment! Please see a professional doctor for further 
                    physical treatments</h4>";
                  }
                ?>
              </ol>
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