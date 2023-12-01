<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$course = @$update_data['course'];
$course_arr = explode(',', $course);
// pre($course_arr);die;
if(isset($update_data)){
  $inquiry_by = $update_data['inq_by'];  
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
     <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-3">
            <h1>Add School Inquiry</h1>
          </div>
          <div class="col-9 d-flex justify-content-end">
            <a href="<?php echo site_url('schoolinq/add_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School</a>
            <a href="<?php echo site_url('schoolinq/view_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School</a>
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School Inq.</a>
            <a href="<?php echo site_url('inquiry/index');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add Inquiry</a>
            <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-list"></i> View Inquiry</a>
          </div>
        <!--   <div class="col-sm-6">
            
              
             <a href="<?php //echo site_url('inquiry/view_web_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Web List</a>
              <a href="<?php //echo site_url('inquiry/view_call_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Call List</a>
              <a href="<?php //echo site_url('inquiry/view_justdial_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> JustDial List</a>
              <a href="<?php //echo site_url('inquiry/view_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Offline List</a>
            
          </div> -->
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
                <h3 class="card-title">School Inquiry</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" id="inquiry-form" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Studednt Name</label>
                      <input type="text" name="name" class="form-control" id="inq_name" placeholder="Enter Name" value="<?php echo @$update_data['s_name'];?>" tabindex="1">
                    </div>
                   
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Student Contact No.</label>
                      <input type="text"  class="form-control" id="contact1" name="contact1" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact1'];?>" tabindex="2">
                    </div>

                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Parent Contact No.</label>
                      <input type="text"  class="form-control" id="contact2" name="contact2" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact2'];?>" tabindex="2">
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Visit Contact No.</label>
                      <input type="text"  class="form-control" id="contact3" name="contact3" placeholder="Enter Contact Number" value="<?php echo @$update_data['contact3'];?>" tabindex="2">
                    </div>

                     <div class="form-group col-4">
                      <label for="exampleInputEmail1">Select School</label>
                      <select class="form-control select2"  id="types" name="school" tabindex="7">
                          <option value="">Select School</option>
                          <?php
                            foreach ($school_data as $s_name)
                            {
                          ?>
                          <option value="<?php echo $s_name['id'] ?>" <?php if($s_name['id']==@$update_data['s_id']) echo 'selected'; ?>><?php echo $s_name['school_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Select Course</label>
                      <input type="text" class="form-control" autocomplete="off" id="txtCourse" name="course" tabindex="4" value="<?php echo @$update_data['course'];?>" placeholder="Enter Course Name...">
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
                             <option value="TEACHER" <?php if(@$update_data['reference']=='TEACHER') { echo 'selected'; } ?>>TEACHER</option> 
                            <option value="OTHER" <?php if(@$update_data['reference']=='OTHER') { echo 'selected'; } ?>>Other</option>  

                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Reference Name</label>
                      <input type="text" name="reference_name" class="form-control" id="exampleInputEmail1" value="<?php echo @$update_data['reference_name'];?>" placeholder="Enter Reference name" tabindex="7">
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
                    <div class="form-group col-4">
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
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Visited Date</label>
                      <input type="date" name="visit_date" class="form-control" value="<?php echo @$update_data['visit_date']?>" tabindex="10">
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Expected Join Date</label>
                      <input type="date" name="demo_date" class="form-control" value="<?php echo @$update_data['expected_date']?>" tabindex="10">
                    </div>
                     <div class="form-group col-4">
                      <label for="exampleInputEmail1">Visited Branch</label>
                      <select class="form-control select2" name="branch_id" id="branch_id" tabindex="9">
                          <option value="">Select Visited Branch</option>
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
                        <option value="IC" <?php if(@$update_data['status']=='IC'){echo 'selected';}?>>In Calling</option>
                        <option value="P" <?php if(@$update_data['status']=='P'){echo 'selected';}?>>Pending</option>
                        <option value="D" <?php if(@$update_data['status']=='D'){echo 'selected';}?>>Demo</option>
                        <option value="V" <?php if(@$update_data['status']=='V'){echo 'selected';}?>>Visited</option>
                        <option value="DC" <?php if(@$update_data['status']=='DC'){echo 'selected';}?>>Decliend</option>
                        <option value="CD" <?php if(@$update_data['status']=='CD'){echo 'selected';}?>>Call Decliend</option>
                        <option value="A" <?php if(@$update_data['status']=='A'){echo 'selected';}?>>Admission</option>
                        <option value="NV" <?php if(@$update_data['status']=='NV'){echo 'selected';}?>>Not Visited</option>
                        <option value="DP" <?php if(@$update_data['status']=='DP'){echo 'selected';}?>>Drop</option>
                      </select>
                    </div>
                    <div class="form-group col-4">
                      <label for="exampleInputEmail1">Extra information</label>
                      <textarea class="form-control" name="extra_info" placeholder="Extra Information" tabindex="6"><?php echo @$update_data['extra_info']?></textarea>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" tabindex="13" class="btn btn-primary" name="submit" value="Submit" >
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
      contact1: {
        required: true,
        number: true,
        rangelength:[10, 10]
      },
      contact2: {
        required: true,
        number: true,
        rangelength:[10, 10]
      },
      contact3: {
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
      school:{
        required:true,
      }
    },
    messages: {
      name: {
        required: "Please enter a name",
      },
      course: {
        required: "Please Select Course",
      },
      contact1: {
        required: "Please enter a contact number",
        number: "Please enter a vaild contact number",
        rangelength: "Contact number is 10 Digits",
      },
      contact2: {
        required: "Please enter a contact number",
        number: "Please enter a vaild contact number",
        rangelength: "Contact number is 10 Digits",
      },
      contact3: {
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
        required: "Please Select Inquiry By Name.",
      },
      added_by:{
        required: "Please Select Added By Name.",
      },
      school:{
        required: "Please Select School.",
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
