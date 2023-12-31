<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
if(isset($update_data)){
  $inquiry_by = $update_data['inquiry_by'];  
}else{
  $inquiry_by = $this->session->userdata('user_login');
}
$hob = @$update_data['course'];
$hob_arr = explode(',', $hob);
$style = "style='display:none'";
if(isset($update_data) && (@$update_data['reference']=='student' or @$update_data['reference']=='other')){
  $style = "style='display:block'";
}
 ?>




  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Online  Inquiry</h1>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->

     <a href="<?php echo site_url('inquiry/view_online_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> View List</a>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">



        

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Inquiry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->

              <div style="color: red;font-size: 20px;margin-left: 28px;">
                    <?php
                      if(form_error('name'))
                      {
                          echo form_error('name');
                      }
                      else if(form_error('contact'))
                      {
                          echo form_error('contact');
                      }
                      // else if(form_error('course'))
                      // {
                      //     echo form_error('course');
                      // }
                      else if(form_error('reference'))
                      {
                          echo form_error('reference');
                      }
                    ?>
              </div>

              <form role="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Enquiry Reference</label>
                    <select class="form-control" name="online_reference">
                        <option value="">Select Reference</option>
                        <option value="Google">Google</option>
                        <option value="JustDial">JustDial</option>
                        <option value="Call">Call</option>
                        <option value="Sulekha">Sulekha</option>
                        <option Website>Website</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Name" value="<?php echo @$update_data['name'];?>">
                  </div>
                 
                  <div class="form-group">
                    <label for="exampleInputEmail1">Contact Number</label>
                    <input type="text" name="contact" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact'];?>">
                  </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Course</label>
                  <select class="select2" multiple="multiple" name="course[]" data-placeholder="Select a Course"
                          style="width: 100%;">
                  <?php
                    foreach ($course_data as $course_info)
                    {
                  ?>
                    <option value="<?php echo $course_info['course_name']?>" <?php if(in_array($course_info['course_name'], $hob_arr)){echo 'selected';}?>><?php echo $course_info['course_name']?></option>
                  <?php } ?>
                  </select>

                  


                   <div class="form-group">
                    <label for="exampleInputEmail1">Visiting Date</label>
                    <input type="date" name="visit_date" class="form-control" value="<?php echo @$update_data['visiting_date']?>" id="exampleInputEmail1" >
                  </div>

                 <div class="form-group">
                    <label for="exampleInputEmail1">Follow Up Fees</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo @$update_data['fees']?>" name="fees" placeholder="Enter FollowUp Fees">
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Location</label>
                    <input type="text" name="location" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Location" value="<?php echo @$update_data['location'];?>">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Enquiry By</label>
                    <select class="form-control" name="enq_by" id="enq_by">
                        <?php
                        foreach($faculties as $faculty){
                        ?>
                        <option value="<?php echo $faculty['id'];?>" <?php if($inquiry_by==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                  </div>

                   <div class="form-group">
                    <label for="exampleInputEmail1">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="P" <?php if(@$update_data['status']=='0'){echo 'selected';}?>>Pending</option>
                        <option value="V" <?php if(@$update_data['status']=='1'){echo 'selected';}?>>Visited</option>
                        
                    </select>
                  </div>

                  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Extra Information</label>
                    <textarea  type="text" class="form-control" id="exampleInputEmail1"
                    name="extra_info" placeholder="Enter Extra Information"><?php echo @$update_data['extra_information']?></textarea>
                  </div>

                <!-- /.card-body -->

                <div class="card-footer">
                  <input type="submit" class="btn btn-primary" name="submit" value="Submit" >
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


<script type="text/javascript">
  $(document).ready(function() {
      $('#types').change(function(){
        //alert('hello'); 
          if($('#types').val() == 'other' || $('#types').val() == 'student') 
          {
              $('#other').css('display', 'block'); 
          }
          else
          {
              $('#other').css('display', 'none');
          }
      });

      $('#status').change(function(){
         

          if($('#status').val() == '1') 
          {
              $('#status1').css('display', 'block'); 
          }
          else
          {
              $('#status1').css('display', 'none');
          }
      });

      if($('#status').val()=='1')
      {
          $('#status1').css('display', 'block');
      }
      else
      {
          $('#status1').css('display', 'none');
      }

       //Initialize Select2 Elements
    $('.select2').select2({
      theme: 'bootstrap4'
    })



  });
</script>
