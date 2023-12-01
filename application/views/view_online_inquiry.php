<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pre($arr);die;
$this->load->view('header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3">
            <h1>View Offline Inquiry</h1>
          </div>
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-6">

            <div class="row">
              
              
              
            </div>


         
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
              <table id="example2" class="table table-bordered table-hover view-data">
                <thead>
                   <!-- <form  method="post">
                  <tr>
                    <td colspan="2">
                      <select class="form-control">
                          <option>Status</option>
                          <option value="DI" >IN Demo</option>
                          <option value="DC" >Declined</option>
                          <option value="DDC" >Demo Declined</option>
                          <option value="A" >Admission</option>
                          <option value="P">Pending</option>
                      </select>
                    </td>
                    <td colspan="3">
                      <select class="form-control" name="search_by" id="search_by">
                            <option value="by_name">By Name</option>
                            <option value="by_contact">By Contact</option>
                      </select>
                    </td>
                    <td colspan="3"><input type="text" id="autouser" class="form-control" placeholder="Search Keyword" name="search_keyword"></td>
                    <td colspan="2"><input type="submit" name="search" value="Search" class="btn btn-primary btn-block"></td>

                    <td colspan="2"><input type="submit" name="see_all" value="See All" class="btn btn-primary  btn-block"></td>
                  </tr>
                </form> -->

                <form method="post" id="search_form" onsubmit="return false;">
            <div class="card-header">
              <div class="row">              
                 <select class="form-control col-1 filter" name="perpage">
                  <option value="2" <?php if(@$perpage==2){echo 'selected';}?>>2</option>
                  <option value="10" <?php if(@$perpage==10){echo 'selected';}?>>10</option>
                  <option value="20" <?php if(@$perpage==20){echo 'selected';}?>>20</option>
                  <option value="30" <?php if(@$perpage==30){echo 'selected';}?>>30</option>
                  <option value="40" <?php if(@$perpage==40){echo 'selected';}?>>40</option>
                  <option value="50" <?php if(@$perpage==50){echo 'selected';}?>>50</option>
                  <option value="100" <?php if(@$perpage==100){echo 'selected';}?>>100</option>
                </select>
                <select class="form-control col-3 ml-2 filter" name="search_by">
                  <option value="byname">Search By Name</option>
                  <option value="byno">Search By No</option>
                  <option value="bycontact">Search By Contact</option>
                </select>
                <input type="text" id="search" name="search_keyword" placeholder="Enter Search Keyword" class="form-control col-4 ml-2 filter">
                <a href="<?php echo site_url('admission/new_data');?>" class="btn btn-primary form-control col-2 ml-2" style="color: white">Search All</a>
              </div>
              <div class="row mt-2">
               
                
              
                 <div class="col-2">
                  <select class="form-control filter" name="course_status" id="status">
                    <option value="">Search By Status</option>
                          <option value="DI" >IN Demo</option>
                          <option value="DC" >Declined</option>
                          <option value="DDC" >Demo Declined</option>
                          <option value="A" >Admission</option>
                          <option value="P">Pending</option>
                          <option value="V">VISITED</option>
                  </select>
                 </div>
                 <div class="col-2 text-center text-bold">
                  Found Results: 
                  <span id="found_results"><?php echo @$found_results;?></span>
                 </div>
              </div>
            </div>
          </form>



                <tr>
                  
                  <th>Inq Id</th>
                  <th>Inquiry Date</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Course<hr style="margin: 5px 0;border-color: #000;">Fees</th>
                  <th>Reference</th>
                 
                  <th>Visit Date</th>
                  
                  <th>Status</th>
                  <th>Extra Info.</th>
                  <th>Inquiry By</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="example3">
                 
                <?php 
                
                  foreach ($arr as $info)
                  {

                    $this->db->where('inquiry_id',$info['id']);
                    $cnt = $this->db->get('followup')->num_rows();

                    // $res = $this->Inquiry_model->last_followup($info['id']);
                    

                     $class = "color:inherit;";
                      if($info['status']=="A"){
                        $class = "color:green;";
                      }else if($info['status']=="D"){
                        $class = "color:red;";
                      }else if($info['status']=="L"){
                        $class = "color:yellow;";
                      }
                   
                    // if($info['status']=='1')
                    // {
                    //     $status = "demo";
                    //     $color = "blue";
                    // }
                    // if($info['status']=='2')
                    // {
                    //     $status = "Declined";
                    //     $color = "red";
                    // }
                    // if($info['status']=='3')
                    // {
                    //     $status = "admission";
                    //     $color = "green";
                    // }
                    
                    $staff_info = $this->CommonModel->get_staff_info($info['inquiry_by']);
                    $demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
                    
                   // $color = "black";
                    //$status = "Pending";
                    //if($info['status']=='2'){
                      //$color = "green";
                      //$status = "Admission";
                    //}
                    //else if($info['status']=='3')
                    //{
                      //$color = "red";
                      //$status = "Declined";
                    //}
                    //else if($info['status']=='1')
                   // {
                      //$color = "blue";
                      //$status = "In Demo";
                    //}
                ?> 
                <tr style="<?php echo $class;?>">
                    <td><?php echo $info['id'];?></td>
                    <td><?php echo date('d-M-Y',strtotime($info['inquiry_time'])) ;?></td>
                    <td><?php echo $info['name'];?></td>
                    <td><?php echo $info['contact'];?></td>
                    <!-- <?php //echo $this->CommonModel->get_course_names($info['course']);?> -->
                    <td> <?php echo $info['course'] ?> <div style="border-top: solid 1px black;margin-top: 5px"><?php echo $info['fees'];?>/-</div></td>
                    <td><?php echo $info['online_reference'];?></td>
                    
                    <td><?php echo $info['visiting_date'] ?></td>
                    
               
                    <td>

                      <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $info['status'];?>" data-inqid="<?php echo $info['id'];?>" data-note="<?php echo $info['status_note'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $info['status_note'];?>"><?php echo $info['status'];?></a>

                    </td>
                    <td><?php echo $info['extra_information'];?></td>
                    <td><?php echo $staff_info['name'];?></td>


                   
                    <td align="center">
                      <a href="<?php echo site_url('inquiry/index/'.$info['id']);?>"><div class="fas fa-edit"></div></a>
                     
                     
                      <?php if($info['status'] != "A") {  ?>
                      <a href="<?php echo site_url('admission/index/'.$info['id'].'/online') ?>" class="badge badge-success">Admission</a>
                      <?php } ?>
                    </td>
                </tr>
              <?php } ?>

               <div class="card-footer small text-muted"><?php echo $this->pagination->create_links(); ?></div>
        
      </div>
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
              <option value="V">Visited</option>
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
        url:"<?php echo site_url('Inquiry/online_inquiry_update_status');?>",
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
        url:"<?php echo site_url('Inquiry/ajax_search_online_inquiry');?>",
        data:formData,
        beforeSend:function(){
          $('.process-loader').show();
        },
        complete:function(){
          $('.process-loader').hide();
        },
        dataType:"json",
        success:function(data){
          $('#example3').html(data.data);
          $('#found_results').html(data.found_results);
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
              url:"<?php echo site_url('Inquiry/ajax_search_online_inquiry');?>",
              data:formData,
              beforeSend:function(){
                $('.process-loader').show();
              },
              complete:function(){
                $('.process-loader').hide();
              },
              dataType:"json",
              success:function(data){
                $('#example3').html(data.data);
                $('#found_results').text(data.found_results);
                $('.pagination-holder').html(data.pagination);
              }
            });    
          }, doneTypingInterval);
        } 
      });


    });
  </script>