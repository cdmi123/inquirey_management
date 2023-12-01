<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>
    <style>
.pagination {
    display: inline-block;
}

.pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
}

.pagination a.active {
    background-color: #343A40;
    color: white;
    border-radius: 5px;
}

.pagination a:hover:not(.active) {
    background-color: #ddd;
    border-radius: 5px;
}
</style> 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-3">
            <h1>View Call Inquiry</h1>
          </div>
          <div class="col-sm-3">
            
          </div>
          <div class="col-sm-6">

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
          
        </div>
      </div>
        <div class="row">
            <div class="col-sm-6">
              <div class="row">
                <a href="<?php echo site_url('inquiry/view_web_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Web List</a>
                <a href="<?php echo site_url('inquiry/view_call_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Call List</a>
                <a href="<?php echo site_url('inquiry/view_justdial_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> JustDial List</a>
                <a href="<?php echo site_url('inquiry/view_inquiry');?>" class="btn btn-primary m-1 float-right" ><i class="fas fa-list"></i> Offline List</a>
              </div>
            </div>
          </div>
      <!-- /.container-fluid -->
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
                   <form  method="post">
                  <tr>
                    <td colspan="3">
                      <select class="form-control" name="search_by" id="search_by">
                            <option value="by_name">By Name</option>
                            <option value="by_date">By Date</option>
                            <option value="by_contact">By Contact</option>
                            <option value="by_course">By Course</option>
                            <option value="by_reference">By Reference</option>
                            <option value="by_status">By Status</option>
                            <option value="by_faculties">By Faculties</option>
                      </select>
                    </td>
                    <td colspan="3"><input type="text" id="autouser" class="form-control" placeholder="Search Keyword" name="search_keyword"></td>
                    <td colspan="2"><input type="submit" name="search" value="Search" class="btn btn-primary btn-block"></td>

                    <td colspan="2"><input type="submit" name="see_all" value="See All" class="btn btn-primary  btn-block"></td>
                  </tr>
                </form>
                <tr>
                  
                  <th>Inq Id</th>
                  <th>Inquiry Date</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Course<hr style="margin: 5px 0;border-color: #000;">Fees</th>
                  <th>Status</th>
                  <th>Extra Info.</th>
                  <th>Inquiry By</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 
                <?php 
                $this->load->model('Inquiry_model');
                  foreach ($arr as $info)
                  {

                    $this->db->where('inquiry_id',$info['id']);
                    $cnt = $this->db->get('call_followup')->num_rows();

                    $res = $this->Inquiry_model->call_last_followup($info['id']);
                    if($info['status']=='0')
                    {
                        $status = "Pending";
                        $color = "black";
                    }
                    if($info['status']=='1')
                    {
                        $status = "demo";
                        $color = "blue";
                    }
                   
                    if($info['status']=='2')
                    {
                        $status = "Declined";
                        $color = "red";
                    }
                     if($info['status']=='4')
                    {
                        $status = "Visited";
                        $color = "orange";
                    }
                    $staff_info = $this->CommonModel->get_staff_info($info['inquiry_by']);
                    $demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'call');
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
                <tr style="color: <?php echo $color;?>">
                    <td><?php echo $info['id'];?></td>
                    <td><?php echo date('d-M-Y',strtotime($info['followup_time'])) ;?></td>
                    <td><?php echo $info['name'];?></td>
                    <td><?php echo $info['contact'];?></td>
                    <td><?php echo $this->CommonModel->get_course_names($info['course']);?>  <div style="border-top: solid 1px black;margin-top: 5px"><?php echo $info['fees'];?>/-</div></td>
                    <td><?php echo $status; ?> <?php if(!empty($demo_details)){?><div style="border-top: solid 1px black;margin-top: 5px"><?php echo $demo_details['name']; }?></div> <a href="<?php echo site_url('inquiry/update_visited_status/'.$info['id']) ?>" class="btn btn-success">Visited</a> <a href="<?php echo site_url('inquiry/update_decliened_status/'.$info['id']) ?>" class="btn btn-danger">Declined</a></td>
                    <td><?php echo $res['followup_reason']?></td>
                    <td><?php echo $staff_info['name'];?></td>
                   
                    <td align="center">
                      <a href="<?php echo site_url('inquiry/call/'.$info['id']);?>"><div class="fas fa-edit"></div></a>
                      &nbsp<a href="<?php echo site_url('call_followup/view_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>
                      <?php 
                      if($this->session->userdata('user_role')!=3){
                      ?>
                      &nbsp<a href="<?php echo site_url('/demolecture/add_demo_offline/call/'.$info['id']);?>"><div class="fas fa-clock"></div></a>
                      <?php }?>
                      <span class="badge badge-warning"><?php echo $cnt-1;?></span>
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

    });
  </script>