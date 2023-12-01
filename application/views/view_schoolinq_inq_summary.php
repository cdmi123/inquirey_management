<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>


<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>School Inquery Report</h1>
          </div>
          <div class="col-sm-6">
            
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                    	<?php $year = date('Y'); ?>
                      <th colspan="11" >School Inquery Report : <?php //echo date('F', mktime(0, 0, 0, $month, 10));?>-<?php echo $year; ?></th>
                    </tr>
                    <tr>
                      <th>Faculty Name</th>
                      <th>Total Data</th>
                      <th>Admission</th>
                      <th>Pending</th>
                      <th>Demo</th>
                      <th>Visited</th>
                      <th>Decliend</th>
                      <th>Call Decliend</th>
                      <th>In Calling </th>
                      <th>Not Visited</th>
                      <th>Drop</th>
                    </tr>
                    	<?php foreach ($schoolinq_repo as $key => $value) { 

                    		foreach ($value as $key => $value1) { 

                    			$this->db->where('id',$key);
                    			$arr = $this->db->get("school_master")->row_array(); ?>
                    		<tr>
                    			<td><?php echo $arr['school_name']; ?></td>
                    			<!-- <td><?php echo $value1['total_count']; ?></td> -->
                    			<?php foreach($value1 as $key => $data) { 

                    				if(is_array($data)){ ?>
                                              <td align="center"><?php if($data['total_count']!=0){ echo $data['total_count']; } else if($data['total_count']==0) { echo "-"; } ?></td>
                                        <?php } else { ?>
                                            <td align="center"><?php echo $data; ?></td>
                                        <?php }  
                                 } ?>	

                    		</tr>
                    	<?php } } ?>
                  </table>
                </div>
          
              </div>
            </div>
            </div>
            <!-- /.card-header -->
            
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