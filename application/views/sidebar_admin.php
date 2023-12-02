<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

$id= $this->session->userdata('user_login');
$role= $this->session->userdata('user_role');

$this->db->where('id',$id);
$arr = $this->db->get('admin')->row_array();

$date_for = date('Y-n-d');
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo site_url();?>" class="brand-link">
      <img src="<?php echo base_url('assets/dist/img/cdmi.jpg')?>" alt="CDMI Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">CDMI | <?php echo $arr['name']?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
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
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Inquiry
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                      <a href="<?php echo site_url('inquiry/index');?>" class="nav-link">
                        <i class="fas fa-plus nav-icon"></i></i>Add Inq
                      </a>
                    </li>
              <li class="nav-item">
                      <a href="<?php echo site_url('inquiry/view_inquiry'); ?>" class="nav-link">
                        <i class="fas fa-desktop nav-icon"></i>View Inq
                      </a>
                    </li>
            </ul>
          </li>
          <?php if($role==1 || $role==2) { ?>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-question"></i>
              <p>
                Manage Staff
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                <a href="<?php echo site_url('admin/index'); ?>" class="nav-link">
                  <i class="fas fa-plus nav-icon"></i> Add Staff
                </a>
              </li>

              <li class="nav-item has-treeview">
                <a href="<?php echo site_url('admin/view_admin'); ?>" class="nav-link">
                  <i class="fas fa-eye nav-icon"></i> View Staff
                </a>
              </li>
            </ul>
          </li>
        <?php } ?>
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