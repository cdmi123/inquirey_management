<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
$role = $this->session->userdata('user_role');

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper p-3">

    <div id="accordion">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h5 class="mb-0">
        <button class="btn btn-block text-left text-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Yogichowk (H/O)
        </button>
      </h5>
    </div>

    <div id="collapseOne" class="collapse <?php if($this->session->userdata('branch_id')==1) { ?> show  <?php } ?> p-3" aria-labelledby="headingOne" data-parent="#accordion">
        <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$b1_cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b1_due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $b1_scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b1_scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->  
    </section>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn collapsed btn-block text-left text-bold" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Katargam
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse <?php if($this->session->userdata('branch_id')==2) { ?> show  <?php } ?>  p-3" aria-labelledby="headingTwo" data-parent="#accordion">
        <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$b2_cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b2_due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $b2_scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b2_scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->  
    </section>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h5 class="mb-0">
        <button class="btn btn-block text-left text-bold collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Utran
        </button>
      </h5>
    </div>
    <div id="collapseThree" class="collapse <?php if($this->session->userdata('branch_id')==3) { ?> show  <?php } ?> p-3" aria-labelledby="headingThree" data-parent="#accordion">
        <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$b3_cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b3_due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $b3_scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b3_scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->  
    </section>
    </div>
  </div>
   <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-block text-left text-bold collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
          Adajan
        </button>
      </h5>
    </div>
    <div id="collapseFour" class="collapse <?php if($this->session->userdata('branch_id')==4) { ?> show  <?php } ?>  p-3" aria-labelledby="headingTwo" data-parent="#accordion">
        <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$b4_cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b4_due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $b4_scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b4_scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->  
    </section>
    </div>
  </div>
   <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button class="btn btn-block text-left text-bold collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">
          Navsari
        </button>
      </h5>
    </div>
    <div id="collapseFive" class="collapse <?php if($this->session->userdata('branch_id')==5) { ?> show  <?php } ?>  p-3" aria-labelledby="headingTwo" data-parent="#accordion">
        <section class="content">
      <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo @$b5_cnt;?></h3> 
                <p>Today Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b5_due_inq;?></h3>
                <p>Due Course Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('inquiry/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
          <?php 
          if($role==1||$role==3||$role==7||$role==4||$role==8){
          ?>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $b5_scl_today;?></h3>
                <p>Today School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/today_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $b5_scl_due;?></h3>
                <p>Due School Visit</p>
              </div>
              <div class="icon">
                <i class="ion ion-help"></i>
              </div>
              <a href="<?php echo site_url('schoolinq/due_followup')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <?php }?>
          <!-- ./col -->
        </div>
      </div><!-- /.container-fluid -->  
    </section>
    </div>
  </div>
</div>

    
  </div>      



  <?php
    $this->load->view('footer');
  ?>



<style type="text/css">
        .lecture_time table tr td{
          padding:5px !important;
        }
      .seat_manage
      {
        position: relative;
        margin-bottom:0;
      }
      .chk_box
      {
        opacity: 0;
        position: absolute;
        /* margin: 40px; */
      }
      .cust_seat
      {
          /* position: absolute;
          left: 0;
          top: 0; */
          display:block;
          height: 40px;
          width: 40px;
          background-color: #f1f1f1;
          border-radius: 5px;
          /* margin: 5px; */
          cursor: pointer;
      }
      .cust_seat:hover
      {
        background-color: #e5e5e5;
      }
      .seat_icon
      {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
      }
      .chk_box:checked + .cust_seat
      {
        background-color: #003366;
      }
      .chk_box:checked + .cust_seat>.seat_icon
      {
        color: #fff;
      }

</style>

<!-- Class assign model -->

<div class="modal fade " id="AssignClassModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Assign Collage Class</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="AssignClassform">
        <!-- <input type="hidden" name="lc_id" id="lc_id" value=""> -->
        <div class="modal-body">
          <label>Select Collage Year</label>
          <div class="form-group">
            <select class="form-control" name="collage_year" tabindex="9">
              <option disabled selected>Select Collage Year</option>
              <option value="FY">First Year (FY)</option>
              <option value="SY">Second Year (SY)</option>
              <option value="TY">Third Year (TY)</option>
            </select>
          </div>

          <label>Select Division</label>
          <div class="form-group">
            <select class="form-control" name="collage_div" tabindex="9">
              <option disabled selected>Select Division</option>
              <option value="Div A">Div A</option>
              <option value="Div B">Div B</option>
              <option value="Div C">Div C</option>
              <option value="Div D">Div D</option>
              <option value="Div E">Div E</option>
              <option value="Div F">Div F</option>
              <option value="Div G">Div G</option>  
            </select>
          </div>

          <label>Lecture Class</label>
          <div class="form-group">
            <input type="text" name="class_name" id="class_name" class="form-control">
          </div>

           <label>Lecture Time</label>
          <div class="form-group">
            <input type="text" name="lecture_time" id="lecture_time" class="form-control">
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- End class assign model -->

<!-- Remove Class model -->

<div class="modal fade" id="RemoveClassModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Collage Class</h5>
        <form id="RemoveClassform">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Class Name:</label>
        <input type="text" id="remove_class_name" class="form-control" readonly>
      </div>
      <div class="modal-body">
        <input type="hidden" id="class_id" class="form-control" name="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Remove Collage Class</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- End Remove Class Model -->

<!-- Remove model -->

<div class="modal fade" id="RemoveClass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Remove Regular Class</h5>
        <form id="RemoveCourse">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Class Name:</label>
        <input type="text" id="remove_class_course" class="form-control" readonly>
      </div>
      <div class="modal-body">
        <input type="hidden" id="class_course_id" class="form-control" name="remove_id">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Remove Class</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- End Remove Class Model -->

<script type="text/javascript">
 $(document).on('click','.assign-class',function(){

        var class_name = $(this).attr('data-lecture');
        var lecture_time = $(this).attr('data-lecture-time');
        $('#class_name').val(class_name);
        $('#lecture_time').val(lecture_time);
        $('#AssignClassModel').modal('show');
        
      });

      $('#AssignClassform').submit(function(){
        var formData = $('#AssignClassform').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/assign_collage_class');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
           if(data==true)
          { 
            $('#AssignClassModel').modal('hide');
          }
          }
        });
        return false;
      });

      $(document).on('click','.remove-class',function(){

        var class_name = $(this).attr('data-class-name');
        var class_id = $(this).attr('data-collage-batch-id');
       
        $('#remove_class_name').val(class_name);
        $('#class_id').val(class_id);
       
        $('#RemoveClassModel').modal('show');
        
      });

      $('#RemoveClassform').submit(function(){
        var formData = $('#RemoveClassform').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/Remove_collage_class');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
           if(data==true)
          { 
            $('#RemoveClassModel').modal('hide');
            window.location.reload();
          }
          }
        });
        return false;
      })



      $(document).on('click','.remove-course',function(){

        var class_name = $(this).attr('data-class-name');
        var class_id = $(this).attr('data-collage-batch-id');
       
        $('#remove_class_course').val(class_name);
        $('#class_course_id').val(class_id);
       
        $('#RemoveClass').modal('show');
        
      });

      $('#RemoveCourse').submit(function(){
        var formData = $('#RemoveCourse').serialize();
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('admission/Remove_Regular_class');?>",
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          success:function(data){
           if(data==true)
          { 
            $('#RemoveClass').modal('hide');
            window.location.reload();
          }
          }
        });
        return false;
      })
 


</script>