<?php 
  include('includes/config.php');

  if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $code = $_POST['code'];

    $check = mysqli_query($conn, "SELECT * FROM users_tbl WHERE email = '$email' AND password = '$code'");

    if(mysqli_num_rows($check) < 1){
      $error = "<div class='alert alert-danger'>Login details do not exist</div>";
    }else{
      $row = mysqli_fetch_assoc($check);
      $_SESSION['id'] = $row['id'];
      $_SESSION['role'] = $row['role'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];

      header("Location:dashboard.php");
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="../assets//img/kaiadmin/favicon.ico" type="image/x-icon" />

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
          urls: ["../assets//css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets//css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets//css/plugins.min.css" />
    <link rel="stylesheet" href="../assets//css/kaiadmin.min.css" />

  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
          <!-- End Navbar -->
        

        <div class="container">
          <div class="page-inner">
            <div class="page-header text-center">
              <h1 class="fw-bold mb-3">Form</h1>
              
            </div>
            <div class="row">
                <div class="col-md-3">

                </div>
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Login Page</div>
                  </div>
                  <div class="card-body">
                    <form action="" method="post">

                    <div class="row">
                        
                      <div class="col-md-8 col-lg-12">
                        <div class="form-group">
                          <label for="email2">Email Address</label>
                          <input type="email" class="form-control" id="email2" name="email" placeholder="Enter Email" />
                        </div>
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input type="password" class="form-control" id="password" name="code" placeholder="Password" />
                        </div>
                        <div class="form-check d-flex">
                            <div>
                                <a href="forgotpassword.php">Forgotten PIN</a>
                            </div>
                            <div class="ms-auto">
                                <span><a href="signupform.php">Sign Up !</a></span>
                            </div>
                        </div>
                      </div>
                      </div>

                        <div class="card-action">
                            <input type="submit" class="btn btn-success" name="submit">
                            <input type="reset" class="btn btn-danger">
                        </div>
                    </div>
                    </form>
                  </div>
                 
                </div>
                
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>
        </div>

    </div>
    <!--   Core JS Files   -->
    <script src="../assets//js/core/jquery-3.7.1.min.js"></script>
    <script src="../assets//js/core/popper.min.js"></script>
    <script src="../assets//js/core/bootstrap.min.js"></script>

  </body>
</html>
