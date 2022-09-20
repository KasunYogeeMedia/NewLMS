<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="home.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item menu-open">
          <?php
          if ($admin == 'True') {
            echo '<a class="nav-link" href="admin.php">
							<i class="nav-icon nav-icon fa fa-user-secret"></i>
							<p>Admin</p>
						</a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Filters
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <?php
              if ($class == 'True') {

                echo '<a href="grade.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Grade</p>
              </a>';
              } else {

                echo '';
              }
              ?>
            </li>
            <li class="nav-item">
              <?php
              if ($subject == 'True') {

                echo '<a href="subject.php" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Subject</p>
              </a>';
              } else {

                echo '';
              }
              ?>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <?php
          if ($students == 'True') {

            echo '<a href="students.php" class="nav-link">
							<i class="nav-icon fa fa-users"></i>
							<p>Students</p>
						</a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item">
          <?php
          if ($teachers == 'True') {

            echo '<a href="attendence.php" class="nav-link">
							<i class="nav-icon fa fa-file-text"></i>
							<p>Students Attendence</p>
						</a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item">
          <?php
          if ($teachers == 'True') {

            echo '<a href="teachers.php" class="nav-link">
							<i class="nav-icon fa fa-black-tie"></i>
							<p>Teachers</p>
						</a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item">
          <?php
          if ($class_schedule == 'True') {

            echo '<a href="class_schedule.php" class="nav-link">
							<i class="nav-icon fa fa-slideshare"></i>
							<p>Class Schedule</p>
					      </a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item">
          <?php
          if ($class_schedule == 'True') {

            echo '<a href="class_tute.php" class="nav-link">
							<i class="nav-icon fa fa-book"></i>
							<p>Class Tute</p>
						  </a>';
          } else {

            echo '';
          }
          ?>
        </li>

        <li class="nav-item">
          <?php
          if ($lesson == 'True') {

            echo '<a href="video_lessons.php" class="nav-link">
							<i class="nav-icon fa fa-play-circle-o"></i>
							<p>Video Lessons</p>
						</a>';
          } else {

            echo '';
          }
          ?>
        </li>
        <li class="nav-item">
          <a href="pages/widgets.html" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Widgets
              <span class="right badge badge-danger">New</span>
            </p>
          </a>
        </li>
        <li class="nav-header">EXAMPLES</li>
        <li class="nav-item">
          <a href="pages/gallery.html" class="nav-link">
            <i class="nav-icon far fa-image"></i>
            <p>
              Gallery
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>