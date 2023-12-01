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
          <div class="col-sm-3">
            <h1>Add School</h1>
          </div>
          <div class="col-9 d-flex justify-content-end">
            <a href="<?php echo site_url('schoolinq/view_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School</a>
            <a href="<?php echo site_url('schoolinq/add_school_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add School Inq.</a>
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School Inq.</a>
            <a href="<?php echo site_url('inquiry/index');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add Inquiry</a>
            <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-list"></i> View Inquiry</a>
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
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add School</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">School Name</label>
                    <input type="text" name="school_name" class="form-control" id="exampleInputEmail1" placeholder="Enter School Name" readonly value="<?php echo @$info['school_name']?>" >
                  </div>

                   <div class="form-group col-12">
                      <label for="exampleInputEmail1">Select Faculty</label>
                      <select class="form-control select2"  id="types" name="caller_id" tabindex="7">
                          <option value="">Select School</option>
                          <?php
                            foreach ($fac_data as $f_name)
                            {
                          ?>
                          <option value="<?php echo $f_name['id'] ?>" <?php if($f_name['id']==@$update_data['s_id']) echo 'selected'; ?>><?php echo $f_name['name'] ?></option>
                        <?php } ?>
                      </select>
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