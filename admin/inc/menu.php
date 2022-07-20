<!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="dashboard.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <?php

          if($_SESSION['user_type'] == 1 || $_SESSION['user_type'] == 2){
            ?>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Posts</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="posts.php?do=show">View All Posts</a></li>
                <li class="nav-item"> <a class="nav-link" href="posts.php?do=add">Add New Posts</a></li>
                <li class="nav-item"> <a class="nav-link" href="category.php">Category</a></li>
              </ul>
            </div>
          </li>


            <?php
          }

          ?>


          <?php
          if($_SESSION['user_type'] == 2){
          ?>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">User Information</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="users.php?do=show">View All Users</a></li>
                <li class="nav-item"><a class="nav-link" href="users.php?do=add">Add New Users</a></li>

              </ul>
            </div>
          </li>
           <li class="nav-item">
            <a class="nav-link"  >
              <i class="icon-bar-graph menu-icon"></i>
              <span class="menu-title">Comments</span>
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Global Setting</span>
            </a>
          </li>

          <?php
          }
          ?>




        </ul>
      </nav>