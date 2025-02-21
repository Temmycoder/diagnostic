<?php
  include("../includes/config.php");
  if(!isset($_SESSION['id'])){
    header('Location:../index.php');
  }
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nick = $_POST['nick'];
    $age = $_POST['age'];
    $code = $_POST['code'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $code_hash = password_hash($code, PASSWORD_DEFAULT);
    $role = 'admin';

    $check = mysqli_query($conn, "SELECT * FROM users_tbl WHERE email = '$email'");

      if(mysqli_num_rows($check) > 0){
        $error = "<div class='alert alert-danger'>Email Address has been used</div>";
      }else{

        $sql = "INSERT INTO users_tbl(name, email, phone, username, age, password, gender, address, role) 
          VALUES('$name', '$email', '$phone', '$nick', '$age', '$code_hash', '$gender', '$address', '$role')";

        if(mysqli_query($conn, $sql)){
          $success = "<div class='alert alert-success'>Registration Successful</div>";
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

        <div class="container">
          <div class="page-inner">
            <?php echo "$error $success"?>
            <form method="post">
              <div class="row ">
                <div class="col-2"></div>
                <div class="col-md-8">
                <h1 class="text-center">Add a new Admin</h1>

                  <div class="form-group">
                    <label for="" class="text-primary">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required autofocus="on"/>
                  </div>

                  <div class="form-group">
                    <label for="" class="text-primary">Username</label>
                    <input type="text" class="form-control" name="nick" placeholder="Enter Username" required/>
                  </div>
                  <div class="form-group">
                    <label for="" class="text-primary">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required/>
                  </div>
                  <div class="form-group">
                    <label for="password" class="text-primary">Password <span class="text-danger">*8 characters only</span></label>
                    <input type="password" class="form-control" name="code" placeholder="Password" maxlength="8" required/>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label class="text-primary">Phone</label>
                      <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required />
                    </div><br>
                    
                    <div class="col-md-6">
                      <label  class="text-primary">Age</label>
                      <input type="number" class="form-control" name="age" placeholder="Age" required/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="text-primary">Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Location" required/>
                  </div>

                  <div class="form-group">
                    <label class="text-primary">Gender</label><br>
                    <div class="d-flex">
                    <h5><input type="radio" name="gender" required value="m">&nbsp;&nbsp; Male</h5> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <h5><input type="radio" name="gender" required value="f">&nbsp;&nbsp; Female</h5>
                    </div>
                  </div>

                </div>

                <div class="card-action text-center">
                    <input type="submit" class="btn btn-success" name="submit">
                    <input type="reset" class="btn btn-danger"><br><br>
                    <a href="user_upload.php">Choose a registration form instead</a>
                </div>
                <div class="col-2"></div>
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