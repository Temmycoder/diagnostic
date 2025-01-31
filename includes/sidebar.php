<?php
  error_reporting(1); 
  $role = $_SESSION['role'];

  if($role == 'admin'){
    $logo = '<a href="index.php" class="logo"><img src="../assets/img/kaiadmin/logo_light.svg" alt="navbar brand" 
    class="navbar-brand" height="20" /></a>';
    $link = "<a href=''><i class='fas fa-desktop'></i>Statistics</a>";
    $link1 = "<a href=''><i class='fas fa-file'></i>Diagnosis</a>";
    $link2 = '<p><a data-bs-toggle="collapse" href="#submenu2"><i class="fas fa-bars"></i>Questions<span class="caret"></span></a></p>
          <div class="collapse" id="submenu2">
            <ul class="nav nav-collapse">
              <li>
                <a href="#">
                  <span class="sub-item">View Questions</span>
                </a>
              <li>
                <a href="#">
                  <span class="sub-item">Add questions</span>
                </a>
              </li>
            </ul>
          </div>';
    $link3 = '<a data-bs-toggle="collapse" href="#submenu">
            <i class="fas fa-bars"></i>
            <p>Admin</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="submenu">
            <ul class="nav nav-collapse">
              <li>
                <a href="#">
                  <span class="sub-item">View All Admins</span>
                </a>
              <li>
                <a href="#">
                  <span class="sub-item">Add New Admins</span>
                </a>
              </li>
            </ul>
          </div>';
    $link4 = '<a href="#">
            <i class="fas fa-file"></i>
            <p>Presciptions</p>
          </a>';
    $link5 = '<a href="#">
            <i class="fas fa-file"></i>
            <p>Knowledge base</p>
          </a>';

  }else{
    $logo = '<a href="index.php" class="logo"><img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" 
    class="navbar-brand" height="20" /></a>';
    $link = "<a><i class='fas fa-desktop'></i>New Test</a>";
    $link1 = "<a><i class='fas fa-file'></i>Medical History</a>";
    $link2 = "<a><i class='fas fa-file'></i>Test History</a>";
    $link4 = '<a href="#">
            <i class="fas fa-file"></i>
            <p>Presciptions</p>
          </a>';
    $link5 = '<a href="#">
            <i class="fas fa-file"></i>
            <p>Edit Profile</p>
          </a>';
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
          <a
            data-bs-toggle="collapse"
            href="#"
            class="collapsed"
            aria-expanded="false"
          >
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
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
          <?php echo"$link5"?>
          
        </li>
        <li class="nav-item">
          <a href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</div>