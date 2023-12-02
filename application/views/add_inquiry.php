<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$course = @$update_data['course'];
$course_arr = explode(',', $course);
// pre($course_arr);die;
if(isset($update_data)){
  $inquiry_by = $update_data['inquiry_by'];  
}
// }else{
//   $inquiry_by = $this->session->userdata('user_login');
// }
$style = "style='display:none'";
if(isset($update_data) && (@$update_data['reference']=='student' or @$update_data['reference']=='other')){
  $style = "style='display:block'";
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <section class="content-header py-2">
      <div class="container-fluid">
        <div class="row">
          <div class="col-3">
            <h1>Add Inquiry</h1>
          </div>
          <div class="col-9 d-flex justify-content-end">
            <a href="<?php echo site_url('schoolinq/add_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School</a>
            <a href="<?php echo site_url('schoolinq/view_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School</a>
            <a href="<?php echo site_url('schoolinq/add_school_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add School Inq.</a>
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School Inq.</a>
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
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary mt-2">
              <div class="card-header">
                <h3 class="card-title">Inquiry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="inquiry-form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Name</label>
                      <input type="text" name="name" class="form-control" id="inq_name" placeholder="Enter Name" value="<?php echo @$update_data['name'];?>" tabindex="1">
                    </div>
                   
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Contact Number</label>
                      <input type="text" name="contact" class="form-control" id="exampleInputEmail1" name="contact" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact'];?>" tabindex="2">
                    </div>
                    <div class="form-group col-4">
                      <label for="parent_contact">Parent Contact</label>
                      <input type="text" name="parent_contact" class="form-control" id="parent_contact" name="parent_contact" placeholder="Enter Parent Contact" value="<?php echo @$update_data['parent_contact'];?>" tabindex="3">
                    </div>
                    
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Select Course</label>
                      <input type="text" class="form-control" autocomplete="off" id="txtCourse" name="course" tabindex="4" value="<?php echo @$update_data['course'];?>" placeholder="Enter Course Name...">
                    </div>  
                    <div class="form-group col-4">
                      <label>Course Content</label>
                      <input type="text" class="form-control" 
                      name="course_content" placeholder="Course Extra Details..." value="<?php echo @$update_data['course_content'];?>" tabindex="5">
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Course Fees</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" value="<?php echo @$update_data['fees']?>" name="fees" placeholder="Course Fees" tabindex="6">
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Reference</label>
                      <select class="form-control"  id="types" name="reference" tabindex="7">
                          <option value="">Select Reference</option>
                          <option value="INTERNET" <?php if(@$update_data['reference']=='INTERNET') { echo 'selected'; } ?>>Internet</option>
                            <option value="STUDENT" <?php if(@$update_data['reference']=='STUDENT') { echo 'selected'; } ?>>Student</option>  
                            <option value="SEMINAR" <?php if(@$update_data['reference']=='SEMINAR') { echo 'selected'; } ?>>Seminar</option> 
                            <option value="STAFF"  <?php if(@$update_data['reference']=='STAFF') { echo 'selected'; } ?>>Staff</option> 
                            <option value="IT-COMPANY"  <?php if(@$update_data['reference']=='IT-COMPANY') { echo 'selected'; } ?>>IT-Company</option>  
                            <option value="OTHER" <?php if(@$update_data['reference']=='OTHER') { echo 'selected'; } ?>>Other</option>  

                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Reference Name</label>
                      <input type="text" name="reference_name" class="form-control" id="exampleInputEmail1" value="<?php echo @$update_data['reference_name'];?>" placeholder="Enter Reference name" tabindex="8">
                    </div>

                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Enquiry By</label>
                      <select class="form-control select2" name="enq_by" id="enq_by" tabindex="9">
                          <option value="">Select Inquiry By</option>
                          <?php
                          foreach($faculties as $faculty){
                          ?>
                          <option value="<?php echo $faculty['id'];?>" <?php if(@$inquiry_by==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                          <?php
                          }
                          ?>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="exampleInputEmail1">Added By</label>
                      <select class="form-control select2" name="added_by" id="added_by" tabindex="9">
                          <option value="">Select Added By</option>
                          <?php
                          foreach($faculties as $faculty){
                          ?>
                          <option value="<?php echo $faculty['id'];?>" <?php if(@$update_data['added_by']==$faculty['id']){echo 'selected';}?>><?php echo $faculty['name'];?></option>
                          <?php
                          }
                          ?>
                      </select>
                    </div>
                    <div class="form-group col-3">
                      <label for="exampleInputEmail1">Expected Join Date</label>
                      <input type="date" name="demo_date" class="form-control" value="<?php echo @$update_data['demo_date']?>" id="exampleInputEmail1" name="contact" tabindex="10">
                    </div>
                    <div class="form-group col-3">
                      <label for="exampleInputEmail1">Batch Time</label>
                      <select class="form-control" name="batch_time" tabindex="11">
                          <option value="">Select Batch Time</option>
                          <option value="8 to 10" <?php if(@$update_data['batch_time']=='8 to 10'){echo 'selected';}?>>8 To 10</option>
                          <option value="10 to 12" <?php if(@$update_data['batch_time']=='10 to 12'){echo 'selected';}?>>10 To 12</option>
                          <option value="12 to 2" <?php if(@$update_data['batch_time']=='12 to 2'){echo 'selected';}?>>12 To 2</option>
                          <option value="2 to 4" <?php if(@$update_data['batch_time']=='2 to 4'){echo 'selected';}?>>2 To 4</option>
                          <option value="4 to 6" <?php if(@$update_data['batch_time']=='4 to 6'){echo 'selected';}?>>4 To 6</option>
                          <option value="6 to 8" <?php if(@$update_data['batch_time']=='6 to 8'){echo 'selected';}?>>6 To 8</option>
                      </select>
                    </div>
                    
                    <div class="form-group col-3">
                      <label for="exampleInputEmail1">Visited Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" tabindex="9">
                          <option value="" selected disabled>Select Visited Branch</option>
                          <?php
                          foreach($branches as $branch){
                          ?>
                          <option value="<?php echo $branch['id'];?>" <?php if(@$update_data['branch_id']==$branch['id']){echo 'selected';}?>><?php echo $branch['branch'];?></option>
                          <?php
                          }
                          ?>
                      </select>
                    </div>
                    
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Status</label>
                      <select class="form-control" name="status" id="status" tabindex="12">
                        <option value="P" <?php if(@$update_data['status']=='0'){echo 'selected';}?>>Pending</option>
                        <option value="D" <?php if(@$update_data['status']=='1'){echo 'selected';}?>>Demo</option>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label >Followup Details</label>
                      <textarea  class="form-control"
                      name="extra_info" placeholder="Enter Followup Details" tabindex="13"><?php echo @$update_data['extra_information'];?></textarea>
                    </div>
                    <div class="form-group col-4">
                      <label >Inquiry Details</label>
                      <textarea class="form-control" name="inq_details" placeholder="Enter Inquiry Details" tabindex="14"><?php echo @$update_data['inq_details'];?></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" tabindex="15" class="btn btn-primary" name="submit" value="Submit" >
                </div>
              </form>
            </div>
         
          </div>
         
        </div>
         <div class="col-md-6">
             
              
              
          </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>



 <?php
      $this->load->view('footer');
 ?>
<script src="<?php echo base_url('assets/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js');?>"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/jquery-migrate-3.0.0.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
$(function() {
  $('#inq_name').focus();
    function split( val ) {
        return val.split( /,\s*/ );
    }
    function extractLast( term ) {
        return split( term ).pop();
    }
    
    $( "#txtCourse" ).bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
            event.preventDefault();
        }
    })
    .autocomplete({
        minLength: 1,
        source: function( request, response ) {
            // delegate back to autocomplete, but extract the last term
            $.getJSON("<?php echo site_url('inquiry/get_ajax_course');?>", { term : extractLast( request.term )},response);
        },
        focus: function() {
            // prevent value inserted on focus
            return false;
        },
        select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
        }
    });
});
  $(document).ready(function() {
  //Initialize Select2 Elements
  $('.select2').select2({
    theme: 'bootstrap4'
  })
  $('#inquiry-form').validate({
    ignore: "",
    rules: {
      name: {
        required: true,
      },
      contact: {
        required: true,
        number: true,
        rangelength:[10, 10]
      },
      course:{
        required:true
      },
      reference:{
        required:true
      },
      extra_info:{
        required: true,
      },
      enq_by:{
        required: true,
      },
      added_by:{
        required: true,
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
      },
      course: {
        required: "Please Select Course",
      },
      contact: {
        required: "Please enter a contact number",
        number: "Please enter a vaild contact number",
        rangelength: "Contact number is 10 Digits",
      },
      reference:{
        required: "Please Select reference",
      },
      extra_info:{
        required: "Please enter Followup Details",
      },
      enq_by:{
        required: "Please Select Inquiry By Name",
      },
      added_by:{
        required: "Please Select Added By Name",
      },
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
