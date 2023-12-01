<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
//pre($arr);die;
$this->load->view('header');
$role = $this->session->userdata('user_role');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <h1>View School Inquiry</h1>
          </div>

           <?php 
              if($role != 8)
              {
           ?>
          <div class="col-8 d-flex justify-content-end">
            
            <a href="<?php echo site_url('schoolinq/view_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-eye"></i> View School</a>
            <a href="<?php echo site_url('schoolinq/add_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School Inq.</a>
            <a href="<?php echo site_url('inquiry/index');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add Inquiry</a>
            <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-eye"></i> View Inquiry</a>
          </div>

        <?php } ?>

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
               <form method="post" id="search_form" onsubmit="return false;">
                <input type="hidden" name="inq_type" value="<?php echo @$type;?>">
                <div class="row mb-3">  
                  <div class="col-1 my-1">            
                    <select class="p-0 form-control filter" name="perpage">
                      
                      <option value="10" <?php if(@$perpage==10){echo 'selected';}?>>10</option>
                      <option value="20" <?php if(@$perpage==20){echo 'selected';}?>>20</option>
                      <option value="30" <?php if(@$perpage==30){echo 'selected';}?>>30</option>
                      <option value="40" <?php if(@$perpage==40){echo 'selected';}?>>40</option>
                      <option value="50" <?php if(@$perpage==50){echo 'selected';}?>>50</option>
                      <option value="100" <?php if(@$perpage==100){echo 'selected';}?>>100</option>
                    </select>
                  </div>
                  <div class="col-3 my-1">
                    <select class="p-0 form-control filter" name="search_by">
                      <option value="byname">By Name</option>
                      <option value="bycontact">By Contact</option>
                      <option value="byno">By Inq No</option>
                    </select>
                  </div>
                  <div class="col-4 my-1">
                    <input type="text" id="search" name="search_keyword" placeholder="Enter Search Keyword" class="form-control p-1">
                  </div>
                  <div class="col-3 my-1">
                    <select class="form-control filter p-0" name="course_status" id="status">
                     <option value="">By Status</option>
                        <option value="IC">In Calling</option>
                        <option value="P">Pending</option>
                        <option value="D">Demo</option>
                        <option value="V">Visited</option>
                        <option value="DC">Decliend</option>
                        <option value="CD">Call Decliend</option>
                        <option value="A">Admission</option>
                        <option value="NV">Not Visited</option>
                        <option value="DP">Drop</option>
                    </select>
                  </div>
                 <!--  <div class="col-4">
                    <select class="form-control filter p-0 select2" multiple="" data-placeholder="By Course" name="course[]" id="course">
                      <option value="">By Course</option>
                      <?php 
                      foreach($course_data as $course){
                      ?>
                      <option value="<?php echo $course['course_name'];?>" ><?php echo $course['course_name'];?></option>
                      <?php }?>
                    </select>
                  </div> -->
                  <div class="col-2 my-1">
                    <select class="form-control filter p-0" name="month" id="month">
                      <option value="">By Month</option>
                      <?php 
                      for($i=date('Y');$i>=2017;$i--){
                        if($i==date('Y')){
                          $m_start = date('m');
                        }else{
                          $m_start = 12;
                        }
                        for($j=$m_start;$j>=1;$j--){
                      ?>
                        <option value="<?php echo $i.'-'.$j; ?>"><?php echo date('M-Y',strtotime($i.'-'.$j));?></option>
                      <?php 
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-3 my-1">
                    <select class="form-control filter p-0 select2" data-placeholder="By Faculty"  name="faculties[]" id="faculties" multiple="">
                      <option value="">By Faculty</option>
                      <?php 
                      foreach($faculties as $fac_id=>$faculty){
                      ?>
                      <option value="<?php echo $faculty['id'];?>" ><?php echo $faculty['name'];?></option>
                      <?php }?>
                    </select>
                  </div>

                  <div class="col-3 my-1">
                    <select class="form-control filter p-0 select2" name="school_name" id="school_name">
                     <option value="">By School</option>
                       <?php
                            foreach ($school_data as $s_name)
                            {
                          ?>
                          <option value="<?php echo $s_name['id'] ?>"><?php echo $s_name['school_name'] ?></option>
                        <?php } ?>
                    </select>
                  </div>

                    <?php
                if($role==1 || $role==3||$role==7)
                {
              ?>
                  <div class="col-sm-1 col-2 my-1">
                  <a href="<?php echo site_url('schoolinq/export_inquiries');?>" class="btn btn-primary" style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
                  </div>
                <?php } ?>  

                    <div class="col-2 text-center text-bold d-flex align-items-center">
                      Found Results: 
                      <span id="found_results"><?php echo @$found_results;?></span>
                    </div>
                  
                </div>
              </form>
              <div class="card-footer small text-muted pagination-holder">
            <?php echo $pagination; ?>
          </div>
              <table  class="table table-bordered table-hover view-data table-font">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>
                    DATE
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    BRANCH
                    </th>
                    <th>
                      NAME
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      CONTACT
                    </th>
                    <?php 
                    if($role==1||$role==3||$role==4){
                    ?>
                    <th>
                      COURSE
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      FEES
                    </th>
                    <th>
                      REF. TYPE
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      REF. NAME
                    </th>
                    <?php } ?>
                    <th>Expected Join Date</th>
                    <th>
                        School Name
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        STD
                    </th>
                    <th>FOLLOW-UP INFO</th>
                    <th>
                      Added By
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      INQ. BY
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      Status
                    </th>
                    <th width="80">ACTION</th>
                  </tr>
                </thead>
                <tbody id="example2">
                <?php 
                  foreach ($arr as $info)
                  {
                    $cnt = 0;
                    if($role==8){
                      $this->db->where('inquiry_id',$info['id']);
                      $this->db->order_by('id','desc');
                      $last_followup = $this->db->get('school_call_followup',1)->row_array();

                      $this->db->where('inquiry_id',$info['id']);
                      $cnt  = $this->db->get('school_call_followup')->num_rows();
                    }else{
                      $this->db->where('inquiry_id',$info['id']);
                      $this->db->order_by('id','desc');
                      $last_followup = $this->db->get('school_followup',1)->row_array();

                      $this->db->where('inquiry_id',$info['id']);
                      $cnt  = $this->db->get('school_followup')->num_rows();
                      if(empty($last_followup)){
                        $this->db->where('inquiry_id',$info['id']);
                        $this->db->order_by('id','desc');
                        $last_followup = $this->db->get('school_call_followup',1)->row_array();

                        $this->db->where('inquiry_id',$info['id']);
                        $cnt  = $this->db->get('school_call_followup')->num_rows();
                      }
                    }
                    if(empty($last_followup))
                    {
                      if($info['extra_info']!= '')
                      {
                        $follow_detail = $info['extra_info'];
                        $follow_date = getSimpleDate($info['updated_at']);
                      }
                      else
                      {
                        $follow_detail = 'NA';
                        $follow_date = 'NA';
                      }
                    }
                    else
                    {
                        $follow_detail = $last_followup['followup_reason'];
                        $follow_date = getSimpleDate($last_followup['followup_date']);
                    }

                    // $this->db->where('inquiry_id',$info['id']);
                    // $cnt = $this->db->get('followup')->num_rows();
                    $class = "color:inherit;";
                    $status = $info['status'];
                    if($info['status']=="A"){
                      $class = "color:green;";
                      $status = "Admission";
                    }else if($info['status']=="DP"){
                      $class = "color:red;";
                      $status = "Drop";
                    }
                    else if($info['status']=="V"){
                      $class = "color:#b014c4;";
                      $status = "Visited";
                    }else if($info['status']=="P"){
                     
                      $status = "Pending";
                    }
                    else if($info['status']=="NV"){
                     
                      $status = "Not Visited";
                    }
                     else if($info['status']=="D"){
                      $class = "color:blue;";
                      $status = "Demo";
                    }
                    else if($info['status']=="DC"){
                      $class = "color:#660000";
                      $status = "Declined";
                    }else if($info['status']=="CD"){
                      $class = "color:#660000";
                      $status = "Call Declined";
                    }else if($info['status']=="IC"){
                      $status = "In Calling";
                    }
                    $staff_info = $this->CommonModel->get_staff_info($info['inq_by']);
                    // $demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
                ?> 
                <tr style="<?php echo $class;?>">
                  <td><?php echo $info['id'];?></td>
                  <td>

                    <?php 
                    if(($info['status']=='V' || $info['status']=='D')&& $info['visit_date']!="") { 
                      echo getSimpleDate($info['visit_date']); 
                    }else if($info['status']!='P'){
                      echo getSimpleDate($info['updated_at']); 
                    } ?>
                    
                   
                  </td>
                  <td>
                    <?php echo $info['s_name'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact1'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact2'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact3'];?>
                  </td>
                  <?php 
                  if($role==1||$role==3||$role==4){
                  ?>
                  <td> 
                    <?php echo $info['course'] ?> 
                  </td>
                  <td>
                    <?php echo $info['reference'];?> 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['reference_name'];?>
                  </td>
                  <?php }?>
                  <td>
                    <?php 
                    if($info['expected_date']=='0000-00-00'){
                      echo $info['expected_date'];
                    }else{
                        echo getSimpleDate($info['expected_date']); 
                    }?>
                  </td>
                  <td>
                    <?php echo $info['school_name'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['standard'];?>
                  </td>
                  <td>
                    
                    <?php echo $follow_detail;?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $follow_date;?>
                   
                  </td>
                  
                  <td>
                    <?php echo !empty($info['added_by_name']) ? $info['added_by_name'] : 'No Name';?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo !empty($staff_info['name']) ? $staff_info['name'] : 'No Name';?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $status; ?>
                  </td>
                  <td align="center">
                    <?php 

                       $user_role =  $this->session->userdata('user_role');

                        if($user_role != 8)
                        {
                     ?>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_school_inquiry/'.$info['id']);?>"><div class="fas fa-edit"></div></a>

                  <?php } ?>

                    
                    <?php 
                    //if($this->session->userdata('user_role')!=3){
                    ?>
                    <!-- <a class="btn btn-primary btn-xs m-1" href="<?php //echo site_url('/demolecture/add_demo_offline/offline/'.$info['id']);?>"><div class="fas fa-clock"></div></a> -->
                    <?php //}?>
                    <!-- <span class="badge badge-warning"><?php //echo $cnt-1;?></span> -->

                    <?php 
                    if($role != 8)
                    {
                    ?>
                      <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/view_college_followup/'.$info['id']);?>"><div class="fas fa-eye"></div>&nbsp;&nbsp;<?php echo $cnt;?></a>
                      <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_followup_data/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>
                    <?php }else{ ?>
                      <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/view_call_followup/'.$info['id']);?>"><div class="fas fa-eye"></div>&nbsp;&nbsp;<?php echo $cnt;?></a>
                      <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('schoolinq/add_telecaller_followup/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>
                    <?php 
                    } 
                    ?>
                    <?php if($info['status'] != "A") {  ?>
                    <!-- <a class="btn btn-primary btn-xs m-1" href="<?php //echo site_url('admission/index/'.$info['id'].'/offline') ?>" class="badge badge-success">Admission</a> -->
                    <?php } ?>
                  </td>
                </tr>
              <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="11">
                    
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="card-footer small text-muted pagination-holder">
            <?php echo $pagination; ?>
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

  <div class="modal fade " id="ChangeStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" id="ChangeStatusForm">
        <input type="hidden" name="inqid" id="inqid" value="">
        <div class="modal-body">
          <div id="update-msg"></div>
          <div class="form-group">
            <label>Select Status</label>
            <select class="form-control" name="status" id="new-status">
              <option value="DI" >IN Demo</option>
              <option value="DC" >Declined</option>
              <option value="DDC" >Demo Declined</option>
              <option value="A" >Admission</option>
              <option value="P">Pending</option>

            
            </select>
          </div>
          <div class="form-group">
            <label>Enter Note</label>
            <textarea class="form-control" name="note" id="note" placeholder="Enter Note"></textarea>
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
 

 <?php
  $this->load->view('footer');
 ?>
 
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
  </head>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type='text/javascript'>
    $(document).ready(function(){
      $('.select2').select2({
        theme: 'bootstrap4'
      })
      $(document).on("click",'.pagination > a',function(e){
        e.preventDefault();
        if($(this).attr('href')=="" || $(this).attr('href') ==null || $(this).attr('href')=="#"){
          return false;
        }
        var formData = $('#search_form').serialize();
        $.ajax({
          type:"POST",
          url:$(this).attr('href'),
          data:formData,
          beforeSend:function(){
            $('.process-loader').show();
          },
          complete:function(){
            $('.process-loader').hide();
          },
          dataType:"json",
          success:function(data){
            $('#example2').html(data.data);
            $('.pagination-holder').html(data.pagination);
          }
        });
      });
      var search_by = $('#search_by').val();
     // Initialize 
     $( "#autouser" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?php echo site_url('inquiry/userList'); ?>",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term,
              search_by:search_by
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
          $('#autouser').val(ui.item.label); // display the selected text
          $('#userid').val(ui.item.value); // save selected id to input
          return false;
        }
      });

     $(document).on('click','.update-status',function(){
        var inqid = $(this).attr('data-inqid');
        var status = $(this).attr('data-status');
        var note = $(this).attr('data-note');
        $('#new-status').val(status);
        $('#note').val(note);
        $('#inqid').val(inqid);
        $('#ChangeStatusModal').modal('show');
     });

      $('#ChangeStatusForm').submit(function(){
      var formData = $('#ChangeStatusForm').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('Inquiry/inquiry_update_status');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        success:function(data){
          $('#update-msg').html(data);
        }
      });
      return false;
    })



    $('.filter').change(function(){
      var formData = $('#search_form').serialize();
      $.ajax({
        type:"POST",
        url:"<?php echo site_url('schoolinq/search_school_inquiry');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#found_results').html(data.found_results);
          $('#example2').html(data.data);
          $('.pagination-holder').html(data.pagination);
        }
      });
    });


       var typingTimer;                //timer identifier
      var doneTypingInterval = 1000;

      $('#search').keyup(function(){
          clearTimeout(typingTimer);
          if ($('#search').val) 
          {
            var formData = $('#search_form').serialize();
            typingTimer = setTimeout(function(){
            $.ajax({
              type:"POST",
              url:"<?php echo site_url('schoolinq/search_school_inquiry');?>",
              data:formData,
              beforeSend:function(){
                $('.process-loader').show();
              },
              complete:function(){
                $('.process-loader').hide();
              },
              dataType:"json",
              success:function(data){
                $('#found_results').html(data.found_results);
                $('#example2').html(data.data);
                $('.pagination-holder').html(data.pagination);
              }
            });    
          }, doneTypingInterval);
        } 
      });


    });
  </script>