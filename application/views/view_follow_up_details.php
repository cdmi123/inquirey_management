<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

 <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Follow-Up Report</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Content Header (Page header) -->
    

    <!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-6">
          	<div class="card">
            	<div class="card-header">
              		<div class="row">
                		<div class="col-md-12">
                  			<table class="table table-bordered table-hover ">
                    			<tr align="center">
                      				<th colspan="10" ><?php $month = date('F'); ?>Follow-Up Report : <?php echo $month; ?></th>
                    			</tr>
                    			<tr>
			                      <th>Total Follow Up:</th>
			                      <th>Today Follow Up:</th>
			                      <th>Pending Follow Up:</th>
                    			</tr>  
                    			<tr>
                    				<td align="center"><?php echo $cnt; ?></td>
                    				<td align="center"><?php echo $cnt1; ?></td>
                    				<td align="center"><?php echo $cnt - $cnt1; ?></td>
                    			</tr>
                  			</table>
                		</div>
              		</div>
            	</div>
          	</div>
        </div>
        <div class="col-6">
          	<div class="card">
            	<div class="card-header">
              		<div class="row">
                		<div class="col-md-12">
                  			<table class="table table-bordered table-hover ">
                    			<tr align="center">
                      				<th colspan="10" >Faculty wise Follow-Up Report : <?php echo $month; ?></th>
                    			</tr>
                    			<tr>
			                      <th>Faculty Name:</th>
			                      <th>Today Follow-up:</th>
			                      <th>Total Follow-up:</th>
                    			</tr>  

                    				
                    			<?php  foreach ($inquery_data as $key => $value) { 

                    				$this->db->where('id',$key);
                         		 	$admin_data = $this->db->get('admin')->row_array();

                                    $cur_year = date("Y");
                                    $cur_month = date("m");
                                    $cur_date = date("d");

                                    $this->db->where('YEAR(followup_date)',$cur_year);
                                    $this->db->where('MONTH(followup_date)',$cur_month);
                                    $this->db->where('followup_by',$key);
                                    $data = $this->db->get('followup');
                                    $total =  $data->num_rows(); 

                    			?>

                    				<tr>
                    					<td><?php echo $admin_data['name']; ?></td>
                    					<td align="center"><?php echo $value['total_count']; ?></td>
                    					<td align="center"><?php echo $total; ?></td>
                    				</tr>
                    			<?php } ?>
                    				

                  			</table>
                		</div>
              		</div>
            	</div>
          	</div>
        </div>
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