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
            <h1>Add Call Inquiry</h1>
          </div>
          <div class="col-sm-6">
            
              
             <a href="<?php echo site_url('inquiry/view_web_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Web List</a>
              <a href="<?php echo site_url('inquiry/view_call_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Call List</a>
              <a href="<?php echo site_url('inquiry/view_justdial_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> JustDial List</a>
              <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Offline List</a>
            
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
                <a href="<?php echo site_url('inquiry/index')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Offline</a>
              </div>

              <div class="col-3">
                <a href="<?php echo site_url('inquiry/justdial')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Justdial</a>
              </div>

               <div class="col-3">
                <a href="<?php echo site_url('inquiry/call')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Call</a>
              </div>

               <div class="col-3">
                <a href="<?php echo site_url('inquiry/web')?>" class="btn btn-primary btn-block my-1"><i class="fas fa-plus"></i> Add Website</a>
              </div>
              
            </div>

            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Call Inquiry</h3>
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

              <form role="form" method="post" id="inq-form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="<?php echo @$update_data['name'];?>">
                  </div>
                 
                  <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" name="contact" class="form-control" id="contact" name="contact" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact'];?>">
                  </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Select Course</label>
                  <select class="select2" id="course" multiple="multiple" name="course[]" data-placeholder="Select a Course"
                          style="width: 100%;">
                  <?php
                    foreach ($course_data as $course_info)
                    {
                  ?>
                    <option value="<?php echo $course_info['id']?>" <?php if(@in_array($course_info['course_name'],@$hob_arr)){echo 'selected';}?>><?php echo $course_info['course_name']?></option>
                  <?php } ?>
                  </select>
              	</div>
                  


                   <div class="form-group">
                    <label for="exampleInputEmail1">Visiting Date</label>
                    <input type="date" name="visit_date" class="form-control" value="<?php echo !empty(@$update_data['visiting_date']) ? @$update_data['visiting_date'] : date('Y-m-d'); ?>" id="exampleInputEmail1" >
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
                        <option value="0" <?php if(@$update_data['status']=='0'){echo 'selected';}?>>Pending</option>
                        <option value="1" <?php if(@$update_data['status']=='1'){echo 'selected';}?>>Demo</option>
                        <option value="2" <?php if(@$update_data['status']=='2'){echo 'selected';}?>>Admission</option>
                        <option value="3" <?php if(@$update_data['status']=='3'){echo 'selected';}?>>Decline</option>
                        <option value="4" <?php if(@$update_data['status']=='4'){echo 'selected';}?>>Visited</option>
                    </select>
                  </div>

                  <div class="form-group" id="status1" style="display: none;">
                    <label for="exampleInputEmail1">Demo Faculty Name</label>
                    <input type="text" class="form-control"  name="faculty_name" value="<?php echo @$update_data['demo_faculty_name']?>" placeholder="Enter Demo Faculty Name">
                  </div>

                 <div class="form-group">
                    <label for="exampleInputEmail1">Reference</label>
                    <select class="form-control"  id="types" name="reference">
                        <option>Select Reference</option>
                        <option value="google" <?php if(@$update_data['reference']=='google'){echo 'selected';}?>>Google</option>
                        <option value="justdial" <?php if(@$update_data['reference']=='justdial'){echo 'selected';}?>>JustDial</option>
                        <option value="sulekha" <?php if(@$update_data['reference']=='sulekha'){echo 'selected';}?>>Sulekha</option>
                        <option value="website" <?php if(@$update_data['reference']=='website'){echo 'selected';}?>>Website</option>
                        <option value="banner" <?php if(@$update_data['reference']=='banner'){echo 'selected';}?>>Banner</option>
                        
                        <option value="student" <?php if(@$update_data['reference']=='student'){echo 'selected';}?>>Student</option>  
                        <option value="other" <?php if(@$update_data['reference']=='other'){echo 'selected';}?>>Other</option>

                    </select>
                  </div>

                     <input type="text" id="other"  placeholder="Enter Reference Name" value="<?php echo @$update_data['reference_name']?>" name="other_ref" class="form-control" <?php echo $style;?>/>  

                  <div class="form-group">
                    <label for="extra_info">Extra Information</label>
                    <textarea  type="text" class="form-control" id="extra_info"
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

<!-- jquery-validation -->
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js');?>"></script>
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


    $.validator.setDefaults({
	    //submitHandler: function () {
	      //alert( "Form successful submitted!" );
	    //}
	  });
	  $('#inq-form').validate({
	    rules: {
	      name: {
	        required: true,
	      },
	      contact: {
	        required: true,
	      	number: true,
	      	rangelength:[10, 10]
	      },
	      'course[]':{
	      	required:true
	      },
	      fees: {
	        required: true,
	      },
	      extra_info:{
	        required: true,
	      },
	    },
	    messages: {
	      name: {
	        required: "Please enter a inquiry name",
	      },contact: {
	        required: "Please enter a contact number",
	        number: "Please enter a vaild contact number",
	        rangelength: "Contact number is 10 Digits"
	      },'course[]': {
	        required: "Please select course",
	      },
	      fees: {
	        required: "Please enter a fees",
	      },
	      extra_info:{
	      	required: "Please enter an Extra Information",
	      }
	    },
	    errorElement: 'span',
	    errorPlacement: function (error, element) {
	      error.addClass('invalid-feedback');
	      element.closest('.form-group').append(error);
	    },
	    highlight: function (element, errorClass, validClass) {
	      $(element).addClass('is-invalid');
	    },
	    unhighlight: function (element, errorClass, validClass) {
	      $(element).removeClass('is-invalid');
	    }
	  });
  });
</script>
