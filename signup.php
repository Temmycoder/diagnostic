<?php
  include('includes/config.php');

  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $nick = $_POST['nick'];
    $age = $_POST['age'];
    $code = $_POST['code'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $check = mysqli_query($conn, "SELECT * FROM users_tbl WHERE email = '$email'");

      if(mysqli_num_rows($check) > 0){
        $error = "<div class='alert alert-danger'>Email Address has been used</div>";
      }else{

        $sql = "INSERT INTO users_tbl(name, email, phone, username, age, password, gender, address) 
          VALUES('$name', '$email', '$phone', '$nick', '$age', '$code', '$gender', '$address')";

        if(mysqli_query($conn, $sql)){
          $success = "<div class='alert alert-success'>Registration Successful</div>";
        }
      }

  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets//img/kaiadmin/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <title>FORM</title>
    <link rel="stylesheet" href="assets//css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets//css/plugins.min.css" />
    <link rel="stylesheet" href="assets//css/kaiadmin.min.css" />
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
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
          urls: ["assets//css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>
    
</head>

<body>
  <div class="container">
    <div class="page-inner">
      <div class="page-header text-center">
        <h1 class="fw-bold mb-3">Form</h1>
      </div>
      <div class="row">
          <div class="col-md-2">

          </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Sign-Up</div>
            </div>
            <div class="card-body">
              <form action="" method="post">

              <?php echo"$error $success";?>
              <div class="row">
                  
                <div class="col-md-8 col-lg-12">
                  <div class="form-group">
                    <label for="">Full Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Full Name" required/>
                  </div>

                  <div class="form-group">
                    <label for="">Nickname</label>
                    <input type="text" class="form-control" name="nick" placeholder="Enter Nickname" required/>
                  </div>
                  <div class="form-group">
                    <label for="">Email Address</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" required/>
                  </div>
                  <div class="form-group">
                    <label for="password">Password <span class="text-danger">*8 characters only</span></label>
                    <input type="password" class="form-control" name="code" placeholder="Password" maxlength="8" required/>
                  </div>

                  <div class="form-group d-md-flex">
                    <div>
                      <label>Phone</label>
                      <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required/>
                    </div><br>
                    
                    <div class="mx-auto">
                      <label >Age</label>
                      <input type="number" class="form-control" name="age" placeholder="Age" required/>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Address</label>
                    <input type="text" class="form-control" name="address" placeholder="Location" required/>
                  </div>

                  <div class="form-group">
                    <label>Gender</label><br>
                    <input type="radio" name="gender" required> Male &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="gender" required> Female
                  </div>

                  <div class="form-check">
                      <div class="">
                          <span><a href="index.php">Already have an account? Login</a></span>
                      </div>
                  </div>
                </div>

                  <div class="card-action text-center">
                      <input type="submit" class="btn btn-success" name="submit">
                      <input type="reset" class="btn btn-danger">
                  </div>
              </div>
              </form>
            </div>
            
          </div>
          
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
  </div>
    <script src="assets//js/core/jquery-3.7.1.min.js"></script>
    <script src="assets//js/core/popper.min.js"></script>
    <script src="assets//js/core/bootstrap.min.js"></script>
</body>
</html>