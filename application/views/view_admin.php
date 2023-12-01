<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-4">
                <a href="<?php echo site_url('admin/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i>  Add Staff Member</a>
              </div>
            </div>
            <h1>Staff List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</l
                i>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Status</th>
                  <th>Role</th>
                  <th>Image</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                  foreach ($arr as $info)
                   {
                ?>
                <tr>
                  <th><?php echo $info['id']?></th> 
                  <th><?php echo $info['name']?></th>
                  <th><?php echo $info['email']?></th>
                  <th><?php echo $info['mobile']?></th>
                  <th>
                    <?php if($info['status']==0){
                      echo 'Pending';
                    }else if($info['status']==1){
                      echo 'Active';
                    }else if($info['status']==2){
                      echo 'Blocked';
                    }?>
                  </th>
                  <th>
                    <?php 
                      if($info['role']==1){
                        echo 'Admin';
                      }else if($info['role']==2){
                        echo 'Faculty';
                      }else if($info['role']==3){
                        echo 'Receptionist';
                      }else if($info['role']==4){
                        echo 'Inquiry Manager';
                      }else if($info['role']==5){
                        echo 'HOD';
                      }else if($info['role']==6){
                        echo 'College';
                      }else if($info['role']==7){
                        echo 'HR';
                      }else if($info['role']==8){
                        echo 'Tele Caller';
                      }
                    ?>
                  </th>
                  <th><img src="<?php echo base_url('upload/'.$info['image']);?>" width="50" height="50" style="border-radius:30px;"></th>
                  <th><a href="<?php echo site_url('admin/index/'.$info['id']);?>" class="btn btn-primary btn-xs m-1"><i class="fas fa-edit"></i></a> <a href="<?php echo site_url('admin/delete_data/'.$info['id']);?>" class="btn btn-primary btn-xs m-1" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a></th>
                </tr>
                <?php
                }
                ?>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
 

 <?php
  $this->load->view('footer');
 ?>