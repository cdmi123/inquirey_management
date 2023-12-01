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
          <div class="col-3">
            <h1>View Inquiry</h1>
          </div>
          <div class="col-9 d-flex justify-content-end">
            <?php 
            if($role==1 || $role==3|| $role==4|| $role==7){
            ?>
            <a href="<?php echo site_url('schoolinq/add_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School</a>
            <a href="<?php echo site_url('schoolinq/view_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School</a>
            <a href="<?php echo site_url('schoolinq/add_school_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add School Inq.</a>
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School Inq.</a>
            <a href="<?php echo site_url('inquiry/index');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add  </a>
            <?php }?>
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content"> 
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header small text-muted pagination-holder">
              <?php echo $pagination; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" id="search_form" onsubmit="return false;">
                <input type="hidden" name="inq_type" value="<?php echo $type;?>">
                <div class="row mb-3">  
                  <div class="col-1">            
                    <select class="p-0 form-control filter" name="perpage">
                      <option value="2" <?php if(@$perpage==2){echo 'selected';}?>>2</option>
                      <option value="10" <?php if(@$perpage==10){echo 'selected';}?>>10</option>
                      <option value="20" <?php if(@$perpage==20){echo 'selected';}?>>20</option>
                      <option value="30" <?php if(@$perpage==30){echo 'selected';}?>>30</option>
                      <option value="40" <?php if(@$perpage==40){echo 'selected';}?>>40</option>
                      <option value="50" <?php if(@$perpage==50){echo 'selected';}?>>50</option>
                      <option value="100" <?php if(@$perpage==100){echo 'selected';}?>>100</option>
                    </select>
                  </div>
                  <div class="col-2">
                    <select class="p-0 form-control filter" name="search_by">
                      <option value="byname">By Name</option>
                      <option value="bycontact">By Contact</option>
                      <option value="byno">By Inq No</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <input type="text" id="search" name="search_keyword" placeholder="Enter Search Keyword" class="form-control p-1">
                  </div>
                  <div class="col-2">
                    <select class="form-control filter p-0" name="course_status" id="status">
                      <option value="">By Status</option>
                      <option value="DI" >IN Demo</option>
                      <option value="DC" >Declined</option>
                      <option value="DDC" >Demo Declined</option>
                      <option value="A" >Admission</option>
                      <option value="IC" >In Calling</option>
                      <option value="P">Pending</option>
                      <option value="T">Branch Transfer</option>
                    </select>
                  </div>
                  <div class="col-4">
                    <select class="form-control filter p-0 select2" multiple="" data-placeholder="By Course" name="course[]" id="course">
                      <option value="">By Course</option>
                      <?php 
                      foreach($course_data as $course){
                      ?>
                      <option value="<?php echo $course['course_name'];?>" ><?php echo $course['course_name'];?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="row mb-2"> 
                  <div class="col-2">
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
                  <div class="col-2">
                    <select class="form-control filter p-0 select2" data-placeholder="By Faculty"  name="faculties[]" id="faculties" multiple="">
                      <option value="">By Faculty</option>
                      <?php 
                      foreach($faculties as $fac_id=>$faculty){
                      ?>
                      <option value="<?php echo $faculty['id'];?>" ><?php echo $faculty['name'];?></option>
                      <?php }?>
                    </select>
                  </div>
                   <div class="col-2">
                    <select class="form-control filter p-0 select2" data-placeholder="By Branch"  name="branch[]" id="branch" multiple="">
                      <option value="">By Faculty</option>
                      <?php 
                      foreach($branches1 as $branch){
                      ?>
                      <option value="<?php echo $branch['id'];?>" ><?php echo $branch['branch'];?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-1 col-2">
                    <?php
                if($role==1 || $role==3|| $role==4|| $role==7)
                {
              ?>
                  <a href="<?php echo site_url('inquiry/export_inquiries');?>" class="btn btn-primary" style="color: white"><i class="fa fa-file-excel" aria-hidden="true"></i></a>
                <?php } ?>  
                  </div>
                    <div class="col-2 text-center text-bold">
                      Found Results: 
                      <span id="found_results"><?php echo @$found_results;?></span>
                    </div>
                  
                </div>
              </form>
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
                    <th>DEMO</th>
                    <th>Inq. Detail</th>
                    <th>FOLLOW-UP INFO</th>
                    <th>
                          Added by
                        <div style="border-top: solid 1px black;margin-top: 5px"></div>
                        INQ. BY
                    </th>
                    <th width="80">ACTION</th>
                  </tr>
                </thead>
                <tbody id="example2">
                <?php 
                  foreach ($arr as $info)
                  {
                    $this->db->where('inquiry_id',$info['id']);
                    $this->db->order_by('id','desc');
                    $last_followup = $this->db->get('followup',1)->row_array();

                    $this->db->where('inquiry_id',$info['id']);
                    $cnt = $this->db->get('followup')->num_rows();
                    $class = "color:inherit;";
                    if($info['status']=="A"){
                      $class = "color:green;";
                      $status = "Admission";
                    }else if($info['status']=="P"){
                      $class = "color:inherit;";
                      $status = "Pending";
                    }else if($info['status']=="DC"){
                      $class = "color:red;";
                      $status = "Declined";
                    }else if($info['status']=="DI"){
                      $class = "color:blue;";
                      $status = "In Demo";
                    }else if($info['status']=="D"){
                      $class = "color:#e08b84;";
                      $status = "Demo Call";
                    }else if($info['status']=="DDC"){
                      $class = "color:orange;";
                      $status = "Demo Declined";
                    }else if($info['status']=="T"){
                      $class = "color:#618500;";
                      $status = "Branch Transfer";
                    }
                    //$staff_info = $this->CommonModel->get_staff_info($info['inquiry_by']);
                    //$demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
                ?> 
                <tr style="<?php echo $class;?>">
                  <td><?php echo $info['id'];?></td>
                  <td>
                    <?php echo getSimpleDate($info['inquiry_time']) ;?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $branches[$info['branch_id']];?>
                  </td>
                  <td>
                    <?php echo $info['name'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['contact'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['parent_contact'];?>
                  </td>
                  <td> 
                    <?php echo $info['course'].' / '.$info['course_content']; ?> 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['fees'] ? $info['fees'] : 0;?>/-
                  </td>
                  <td>
                    <?php echo $info['reference'];?> 
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo $info['reference_name'];?>
                  </td>
                  <td>
                    <?php 
                    if($info['demo_date']=="" && $info['batch_time']==""){
                      echo 'NA';
                    }else{ ?>
                      <?php echo $info['batch_time'];?>  
                      <div style="border-top: solid 1px black;margin-top: 5px"></div>
                      <?php echo getSimpleDate($info['demo_date']); ?>
                    <?php }?>
                  </td>
                  <td>
                    <?php echo $info['inq_details'];?>
                  </td>
                  <td>
                    <?php 
                    if(!empty($last_followup)){
                    ?>
                    <?php echo $last_followup['followup_reason'];?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo getSimpleDate($last_followup['followup_date']);?>
                    <?php }else{ echo 'NA';}?>
                  </td>
                  <td>
                    <?php echo !empty($info['added_by_name']) ? $info['added_by_name'] :'No Name'; ?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <?php echo !empty($info['inq_by_name']) ? $info['inq_by_name'] :'No Name'; ?>
                    <div style="border-top: solid 1px black;margin-top: 5px"></div>
                    <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $info['status'];?>" data-inqid="<?php echo $info['id'];?>" data-note="<?php echo $info['status_note'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $info['status_note'];?>"><?php echo $status;?></a>
                  </td>
                  <td align="center">
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('inquiry/index/'.$info['id']);?>"><div class="fas fa-edit"></div></a>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('followup/view_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>
                    <?php 
                    //if($this->session->userdata('user_role')!=3){
                    ?>
                    <!-- <a class="btn btn-primary btn-xs m-1" href="<?php //echo site_url('/demolecture/add_demo_offline/offline/'.$info['id']);?>"><div class="fas fa-clock"></div></a> -->
                    <?php //}?>
                    <!-- <span class="badge badge-warning"><?php //echo $cnt-1;?></span> -->
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('followup/add_followup_data/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>
                    <?php if($info['status'] != "A") {  ?>
                    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('admission/index/'.$info['id'].'/offline') ?>" class="badge badge-success">Admission</a>
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
              <option value="IC" >In Calling</option>
              <option value="P">Pending</option>
              <option value="T">Branch Transfer</option>
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
        url:"<?php echo site_url('Inquiry/search_offline_inquiry');?>",
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
              url:"<?php echo site_url('Inquiry/search_offline_inquiry');?>",
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