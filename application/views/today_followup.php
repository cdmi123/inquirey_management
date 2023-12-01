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
          <div class="col-sm-6">
            <h1>Today Follow - Up</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
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
              <table id="example2" class="table table-bordered table-hover">
                 <tr>
                  
                  <th>Inq Id</th>
                  <th>Inquiry Date</th>
                  <th>Name</th>
                  <th>Contact</th>
                  <th>Course<hr style="margin: 5px 0;border-color: #000;">Fees</th>
                  <th>Reference</th>
                 
                  <th>Batch Time</th>
                  <th>Demo Date</th>
                  <th>Status</th>
                  <th>Extra Info.</th>
                  <th>Inquiry By</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 
                <?php 
               
                  foreach ($arr as $info)
                  {

                    $this->db->where('inquiry_id',$info['id']);
                    $cnt = $this->db->get('followup')->num_rows();

                    $res = $this->Inquiry_model->last_followup($info['id']);
                    if($info['status']=='P')
                    {
                        $status = "Pending";
                        $color = "black";
                    }
                    if($info['status']=='D')
                    {
                        $status = "demo";
                        $color = "blue";
                    }
                    if($info['status']=='A')
                    {
                        $status = "admission";
                        $color = "green";
                    }
                    if($info['status']=='DC')
                    {
                        $status = "Declined";
                        $color = "red";
                    }
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
                    <td><?php echo date('d-M-Y',strtotime($info['inquiry_time'])) ;?></td>
                    <td><?php echo $info['name'];?></td>
                    <td><?php echo $info['contact'];?></td>
                    <td><?php echo $info['course'];?>  <div style="border-top: solid 1px black;margin-top: 5px"><?php echo $info['fees'];?>/-</div></td>
                    <td><?php echo $info['reference'];?> <?php if($info['reference']=='other' || $info['reference']=='student') {?><div style="border-top: solid 1px black;margin-top: 5px"><?php } ?><?php echo $info['reference_name'];?></td>
                    
                    <td><?php echo $info['batch_time'];?></td>
                    <td><?php if($info['demo_date']=='0000-00-00'){ echo 'Not Mentioned';}else {echo $info['demo_date']; }?></td>
               
                    <td><?php echo $status; ?> <?php if($status=='demo'){?><div style="border-top: solid 1px black;margin-top: 5px"><?php echo $info['demo_faculty_name']; }?></div></td>
                    <td><?php echo $res['followup_reason']?></td>
                    <td><?php echo $info['inq_by_name'];?></td>
                   
                    <td align="center">
                      <a href="<?php echo site_url('inquiry/index/'.$info['id']);?>"><div class="fas fa-edit"></div></a>&nbsp<a href="<?php echo site_url('followup/view_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>
                      <span class="badge badge-warning"><?php echo $cnt;?></span>
                    </td>
                </tr>
              <?php } ?>
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