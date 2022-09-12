
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('dashboard'); ?>" class="brand-link">
      <img src="<?php echo base_url('assets/images/image.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light" style="font-size: 18px;">Traffic Monitring</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <?php 
          if($this->session->user_img !='' && $this->session->user_img !=null)
          {
            echo '<img src="'.base_url($this->session->user_img).'" class="img-circle elevation-2" alt="User Image">';
          }
          else
          {
             echo '<img src="'.base_url("assets/profile/user/user.png").'" class="img-circle elevation-2" alt="User Image">';
          }?>
        </div>
        <div class="info">
          <a href="<?= base_url("profile")?>" class="d-block"><?= $this->session->user_name; ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="<?= base_url('dashboard');?>" class="nav-link" id="pg-dashboard">
              <i class="nav-icon fa fa-dashboard"></i>
                <p>
                  Dashboard
                </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?= base_url('dashboard/current');?>" class="nav-link" id="pg-current">
              <i class="nav-icon fa fa-search"></i>
                <p>
                  Current
                </p>
            </a>
          </li>
          
          <li class="nav-item has-treeview nav-user">
            <a href="#" class="nav-link user-link">
              <i class="nav-icon fa fa-user-circle-o"></i>
              <p>
                Site Content
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview ">
                <a href="<?= base_url('Thana')?>" class="nav-link client" id="pg-ti">
                  <i class="nav-icon fa fa-user-secret"></i>
                    <p>
                    Thana Incharge
                  </p>
                </a>
              </li>
              <li class="nav-item has-treeview ">
                <a href="<?= base_url('staff')?>" class="nav-link client" id="pg-staff">
                  <i class="nav-icon fa fa-user-o"></i>
                    <p>
                    Staff
                  </p>
                </a>
              </li>
            </ul>
          </li>
          <?php if($this->session->user_type!=3){ ?>
          
          <li class="nav-item has-treeview nav-attendance">
            <a href="#" class="nav-link attendance-link">
              <i class="nav-icon fa fa-clock-o"></i>
              <p>
                Attendance
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('attendance') ?>" class="nav-link" id="pg-takeatte">
                  <i class="fa fa-calendar-check-o nav-icon"></i>
                  <p>Take Attendance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('attendance/report') ?>" class="nav-link" id="pg-reportatte">
                  <i class="fa fa-calendar nav-icon"></i>
                  <p>Attendance Report</p>
                </a>
              </li>
            </ul>
          </li>
          <?php }?>
          <li class="nav-item has-treeview nav-place">
            <a href="#" class="nav-link place-link">
              <i class="nav-icon fa fa-map"></i>
              <p>
                Place
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview ">
                <a href="<?= base_url('station')?>" class="nav-link client" id="pg-station">
                    <i class="nav-icon fa fa-home"></i>
                      <p>
                      Station
                    </p>
                  </a>
              </li>
              <li class="nav-item has-treeview ">
                  <a href="<?= base_url('area')?>" class="nav-link client" id="pg-area">
                    <i class="nav-icon fa fa-map-marker"></i>
                      <p>
                      Area
                    </p>
                  </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview ">
            <a href="<?= base_url('challan')?>" class="nav-link client" id="pg-challan">
                <i class="nav-icon fa fa-file"></i>
                  <p>
                  Challan
                </p>
              </a>
          </li>
           <li class="nav-item has-treeview ">
            <a href="<?= base_url('notification')?>" class="nav-link client" id="pg-note">
                <i class="nav-icon fa fa-bell"></i>
                  <p>
                  Notification
                </p>
              </a>
          </li>
          <li class="nav-item has-treeview ">
              <a href="<?= base_url('fine')?>" class="nav-link client" id="pg-fine">
                <i class="nav-icon fa fa-money"></i>
                <p>
                  Fine
                </p>
              </a>
          </li>
          <li class="nav-item has-treeview ">
              <a href="<?= base_url('report')?>" class="nav-link client" id="pg-report">
                <i class="nav-icon fa fa-file-o"></i>
                <p>
                  Report
                </p>
              </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
