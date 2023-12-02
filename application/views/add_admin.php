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
            <h1>Add New Staff</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <div class="row">
              <div class="col-3">
                <a href="<?php echo site_url('admin/view_admin')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-list"></i> Staff List</a>
              </div>
            </div>
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add New Staff</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="<?php echo @$data1['name'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" value="<?php echo @$data1['email'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact Number</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Contact Number" value="<?php echo @$data1['mobile'];?>">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
                    <img height="60px" src="<?php echo base_url('upload/'.@$data1['image'])?>">
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status">
                        <option>Select Status</option>
                        <option value="0" <?php if(@$data1['status']==0){echo 'selected';}?>>Pending</option>
                        <option value="1" <?php if(@$data1['status']==1){echo 'selected';}?>>Activate</option>
                        <option value="2" <?php if(@$data1['status']==2){echo 'selected';}?>>Block</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Role</label>
                    <select class="form-control" name="role">
                        <option value="1" <?php if(@$data1['role']==1){echo 'selected';}?>>Super Admin</option>
                        <option value="2" <?php if(@$data1['role']==2){echo 'selected';}?>>Branch Manager</option>
                        <option value="3" <?php if(@$data1['role']==3){echo 'selected';}?>>Inquery Manager</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Branch</label>
                    <select class="form-control" name="branch_id">
                       <?php
                          foreach($branches as $branche){
                          ?>
                          <option value="<?php echo $branche['id'];?>" <?php if(@$data1['branch_id']==$branche['id']){echo 'selected';}?>><?php echo $branche['branch'];?></option>
                          <?php
                          }
                          ?>
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </div>
              </form>
            </div>
          
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

 <?php
      $this->load->view('footer');
 ?>