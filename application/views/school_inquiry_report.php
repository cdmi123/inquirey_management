<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Inquiry Monthwise Report</h1>
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
                
             
                <?php 
                foreach($summary as $key=>$rows){
                ?>
                <div class="col-md-6">
                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                      <th colspan="7" >Report <?php echo $key;?></th>
                    </tr>
                    <tr>
                      <th>Month</th>
                      <th>Total</th>
                      <th>Pending</th>
                      <th>Visited</th>
                      <th>Declined</th>
                      <th>Demo</th>
                      <th>Admission</th>
                    </tr>
                    <?php 
                    $grand_total = 0;
                    $grand_visited = 0;
                    $grand_pending = 0;
                    $grand_declined = 0;
                    $grand_demo = 0;
                    $grand_admission = 0;
                    foreach($rows as $row){ 
                      $grand_total +=$row['total_count'];
                      $grand_pending +=$row['pending'];
                      $grand_visited +=$row['visited'];
                      $grand_declined +=$row['declined'];
                      $grand_demo +=$row['demo'];
                      $grand_admission +=$row['admission'];
                    ?>
                    <tr>
                      <td><?php echo $key.'-'.$row['month_name'];?></td>
                      <td><?php echo $row['total_count'];?></td>
                      <td><?php echo $row['pending'];?></td>
                      <td><?php echo $row['visited'];?></td>
                      <td><?php echo $row['declined'];?></td>
                      <td><?php echo $row['demo'];?></td>
                      <td><?php echo $row['admission'];?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th>Grand Total</th>
                      <th><?php echo $grand_total;?></th>
                      <th><?php echo $grand_pending;?></th>
                      <th><?php echo $grand_visited;?></th>
                      <th><?php echo $grand_declined;?></th>
                      <th><?php echo $grand_demo;?></th>
                      <th><?php echo $grand_admission;?></th>
                    </tr>
                  </table>
                </div>
                <?php 
                }
                ?> 
              </div>
              <?php foreach($summary1 as $k=>$summary_info_months) { 
                foreach($summary_info_months as $l=>$summary_info){
                ?>
                <div class="col-md-6">
                  <table class="table table-bordered table-hover ">
                    <tr align="center">
                      <th colspan="10" >Faculty Report : <?php echo date('F', mktime(0, 0, 0, $l, 10));?>-<?php echo $k; ?></th>
                    </tr>
                    <tr>
                      <th>Faculty Name</th>
                      <th>Total Inquiry</th>
                      <th>Month</th>
                      <th>Year</th>
                      <th>Admission</th>
                      <th>Demo</th>
                      <th>Visited</th>
                      <th>Declined</th>
                      <th>Pending</th>
                      <th>Transfer</th>
                      <th>Admission Ratio</th>

                    </tr>
                      <?php 
                foreach($summary_info as $facid=>$rows) {
                  $this->db->where('id',$facid);
                  $admin_data = $this->db->get('admin')->row_array(); ?>
                    <tr>
                      <td><?php echo $admin_data['name'] ?></td>
                     
                     
                             <?php 
                            // echo $rows['total_count'];die;
                             if($rows['A']['total_count']==0){
                              $ratio=0;
                             }else{
                              $ratio = round((100 * $rows['A']['total_count']) /$rows['total_count'],2) ; 
                             }
                      
                             foreach ($rows as $inq_data) {


                              ?>
                            <?php if(is_array($inq_data))
                              { ?>
                                <td><?php  echo $inq_data['total_count']; ?></td>
                             <?php }
                             
                             else{ ?>
                                <td><?php echo $inq_data ?></td>
                              <?php }?>
                            
                             <?php } ?>
                     
                     <td><?php echo $ratio; ?>%</td>
                    </tr>
                     <?php } ?>
                  </table>
                </div>
              <?php } 
            }
            ?>
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


 <script type="text/javascript">
   $(document).ready(function(){

       $('.filter').change(function(){
          var formData = $('#search_form').serialize();
          
        $.ajax({
          type:"POST",
          url:"<?php echo site_url('fees/fees_rec');?>",
          data:formData,
          
          success:function(data){
            $('#example3').html(data);
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
                url:"<?php echo site_url('fees/fees_rec');?>",
                data:formData,
                success:function(data){
               $('#example3').html(data);
                  
                }
               })

                }, doneTypingInterval); 
          }
        });


   })
</script>