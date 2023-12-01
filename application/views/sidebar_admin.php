<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$id= $this->session->userdata('user_login');
$this->db->where('id',$id);
$arr = $this->db->get('admin')->row_array();

$date_for = date('Y-n-d');
$punchData = $this->db->query("SELECT MIN(time) inTime,MAX(time) outTime FROM `tblt_timesheet` where date='$date_for' and punchingcode=".$arr['punchcode'])->row_array();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url();?>" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/cdmi.jpg')?>" alt="CDMI Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CDMI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url('upload/'.$arr['image'])?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arr['name']?></a>
          <p class="text-white mb-0">In : <?php echo $punchData['inTime'] ? $punchData['inTime'] : "00:00"; ?><br>Out: <?php echo $punchData['outTime'] ? $punchData['outTime'] : "00:00"; ?></p>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo site_url('dashboard/index');?>" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
                Dashboard
            </a>
          </li>
          <?php 
          if($arr['role'] == 5 ){
          ?>
          <li class="nav-item">
            <a href="<?php echo site_url('admission/view_faculty_students'); ?>" class="nav-link">
              <i class="nav-icon fas fa-laptop-code"></i>
              <p>
                IT/Multimedia 
              </p>
            </a>
          </li>
          <?php }?>
          <?php 
          if($arr['role'] == 1 || $arr['role'] == 3 || $arr['role'] == 4 || $arr['role'] == 7){
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Inquiry
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add Inq
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview peta_menu">
                    <li class="nav-item">
                      <a href="<?php echo site_url('inquiry/index');?>" class="nav-link">
                        <i class="fas fa-desktop nav-icon"></i>Regular Inq
                      </a>
                    </li>
                    <!-- <li class="nav-item">
                      <a href="<?php //echo site_url('schoolinq/add_school_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>School Inq
                      </a>
                    </li> -->
                </ul>
              </li>

              <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i> View Inq
                  <i class="fas fa-angle-left right"></i>
                </a>
                <ul class="nav nav-treeview peta_menu">
                    <li class="nav-item">
                      <a href="<?php echo site_url('inquiry/view_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-desktop nav-icon"></i>Regular Inq
                      </a>
                    </li>
                    <!-- <li class="nav-item">
                      <a href="<?php //echo site_url('schoolinq/view_school_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-building nav-icon"></i>School Inq
                      </a>
                    </li> -->
                </ul>
              </li>
            </ul>
          </li>
          <?php }?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <style type="text/css">
    
    .peta_menu{
      margin-left: 20px;
    }

  </style>