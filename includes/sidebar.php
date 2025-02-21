<?php
  error_reporting(1); 
  $role = $_SESSION['role'];

  if($role == 'admin'){
    $logout = '<a href="../logout.php"><i class="fa fa-arrow-left"></i>Logout</a>';
    $logo = '<a href="dashboard.php" class="logo"><img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" /></a>';
    $link = "<a href=''><i class='fas fa-desktop'></i>Statistics</a>";
    $link1 = "<a href='diagnosis.php'><i class='fas fa-file'></i>Diagnosis</a>";
    $link2 = '<p><a data-bs-toggle="collapse" href="#submenu2"><i class="fas fa-bars"></i>Questions<span class="caret"></span></a></p>
              <div class="collapse" id="submenu2">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="questions.php">
                      <span class="sub-item">View Questions</span>
                    </a>
                  <li>
                    <a href="new_questions.php">
                      <span class="sub-item">Add questions</span>
                    </a>
                  </li>
                </ul>
              </div>';
    $link3 = '<p><a data-bs-toggle="collapse" href="#submenu">
                <i class="fas fa-bars"></i>
                Admin
                <span class="caret"></span>
              </a>
              </p>
              <div class="collapse" id="submenu">
                <ul class="nav nav-collapse">
                  <li>
                    <a href="admins.php">
                      <span class="sub-item">View All Admins</span>
                    </a>
                  </li>
                  <li>
                    <a href="new_admin.php">
                      <span class="sub-item">Add New Admins</span>
                    </a>
                  </li>
                  <li>
                    <a href="bulk_upload.php">
                      <span class="sub-item">Bulk Upload</span>
                    </a>
                  </li>
                </ul>
              </div>';
    $link4 = '<p><a href="prescriptions.php"><i class="fas fa-file"></i>Presciptions</a></p>';
    $link5 = '<p><a href="#"><i class="fas fa-file"></i>Knowledge base</a></p>';
    $link6 = '<a href="new_category.php"><i class="fa fa-edit"></i><span class="sub-item">Categories</span></a>';

  }else{
    $logout = '<a href="../logout.php"><i class="fa fa-arrow-left"></i>Logout</a>';
    $logo = '<a href="#" class="log ps-md-0 ps-5"><img src="../assets/img/kaiadmin/favicon.ico" /><span class="ps-2">DR.Webstack</span></a>';
    $link = "<a href='take_test.php'><i class='fas fa-desktop'></i>Take Test</a>";
    $link1 = "<a href='#'><i class='fas fa-file'></i>Medical History</a>";
    $link2 = "<p><a href='test_history.php'><i class='fas fa-file'></i>Test History</a></p>";
    $link3 = '<p><a href="#"><i class="fa fa-list"></i>Presciptions</a></p>';
    $link4 = '<a href="#"><i class="fas fa-user"></i>Edit Profile</a>';
  }
?>
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <?php echo"$logo"; ?>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item active">
          <a href="dashboard.php"><i class="fas fa-home"></i><p>Dashboard</p></a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
            <p><?php echo"$link"?></p>
        </li>
        <li class="nav-item">
            <p><?php echo"$link1"?></p>
        </li>
        <li class="nav-item">
          <?php echo"$link2"?>
        </li>
        <li class="nav-item">
          <?php echo"$link3"?>
        </li>
        <li class="nav-item">
          <?php echo"$link4"?>
        </li>
        <li class="nav-item">
          <p><?php echo"$link6"?></p>
        </li>
        <li class="nav-item">
          <?php echo"$link5"?>
        </li>
        <li class="nav-item">
          <p><?php echo"$logout"?></p>
        </li>
      </ul>
    </div>
  </div>
</div>