<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
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
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            
          </li>

          <?php
          if($arr['role']==1){
          ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Manage Staff
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admin/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Staff</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admin/view_admin'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Staff List</p>
                </a>
              </li>

            </ul>
          </li>
         

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Course
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('course/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('course/view_course'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Course</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('course_cover/index'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Course Cover</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('course_cover/view_course'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Course Cover</p>
                </a>
              </li>

            </ul>
          </li>
          <?php }?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Inquiries
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('inquiry/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Offline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('inquiry/online'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p> Online </p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                IT/Multimedia
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('admission/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('admission/view_admission'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>

            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                College
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('College_admission/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('College_admission/view_college_admission'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Multimedia Fees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('fees/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('fees/view_fees'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View</p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                College Fees
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo site_url('College_fees/index');?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add College Fees</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo site_url('College_fees/view_college_fees'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View College Fees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('College_fees/view_exam_fees'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Exam Fees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo site_url('College_fees/view_certificate_fees'); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Certificate Fees</p>
                </a>
              </li>


            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>