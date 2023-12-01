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
            <h1>View School</h1>
          </div>
          <div class="col-9 d-flex justify-content-end">
            <a href="<?php echo site_url('schoolinq/add_school');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School</a>
            <a href="<?php echo site_url('schoolinq/view_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-list"></i> View School Inq.</a>
            <a href="<?php echo site_url('schoolinq/add_school_inquiry');?>" class="btn btn-sm btn-primary m-1" ><i class="fas fa-plus"></i> Add School Inq.</a>
            <a href="<?php echo site_url('inquiry/index');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-plus"></i> Add Inquiry</a>
            <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-sm btn-primary m-1 " ><i class="fas fa-list"></i> View Inquiry</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <div class="card-header small text-muted pagination-holder">
              <?php echo $pagination; ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" id="search_form" onsubmit="return false;">
                <div class="row mb-3">  
                  <div class="col-1">            
                    <select class="p-0 form-control filter" name="perpage">
                      <option value="10" <?php if(@$perpage==10){echo 'selected';}?>>10</option>
                      <option value="20" <?php if(@$perpage==20){echo 'selected';}?>>20</option>
                      <option value="30" <?php if(@$perpage==30){echo 'selected';}?>>30</option>
                      <option value="40" <?php if(@$perpage==40){echo 'selected';}?>>40</option>
                      <option value="50" <?php if(@$perpage==50){echo 'selected';}?>>50</option>
                      <option value="100" <?php if(@$perpage==100){echo 'selected';}?>>100</option>
                    </select>
                  </div>
                  <div class="col-3">
                    <input type="text" id="search" name="search_keyword" placeholder="Search School Name" class="form-control p-1">
                  </div>
                  <div class="col-2 text-center text-bold">
                    Found Results: 
                    <span id="found_results"><?php echo @$found_results;?></span>
                  </div>
                </div>
              </form>
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>School Name</th>
                  <th>Total Student</th>
                  <th>Today Call</th>
                  <th>Tele-caller</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody id="example2">
                <?php 
                  foreach ($arr as $info)
                  {
                    $today_call = $this->Schoolinq_model->count_call_by_school($info['id'],$info['caller_id']);
                    if($info['caller_id'] !=0)
                    {
                      $this->db->where('id',$info['caller_id']);
                      $data = $this->db->get('admin')->row_array();
                      $name = isset($data['name']) ?$data['name']:"No Name";
                    }
                    else
                    {
                      $name = "Not Assign";
                    }
                    
                ?>
                <tr>
                  <th><?php echo $info['id']?></th>
                  <th><?php echo $info['school_name'];?></th>
                  <th><?php echo $info['total_count'];?></th>
                  <th><?php echo $today_call;?></th>
                  <th><?php echo $name; ?></th>
                  <th>
                    <a href="<?php echo site_url('schoolinq/add_school/'.$info['id']);?>">Edit</a>
                    <!-- || <a href="<?php //echo site_url('schoolinq/delete_data/'.$info['id']);?>">Delete</a> -->
                  </th>

                </tr>
                <?php
                }
                ?>
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
 

 <?php
  $this->load->view('footer');
 ?>
    <script type='text/javascript'>
    $(document).ready(function(){
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
              url:"<?php echo site_url('schoolinq/ajax_search_school');?>",
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