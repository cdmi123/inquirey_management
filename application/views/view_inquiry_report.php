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
                      <th colspan="6" >Report-<?php echo $key;?></th>
                    </tr>
                    <tr>
                      <th>Month</th>
                      <th>Total</th>
                      <th>Adm</th>
                      <th>Pending</th>
                      <th>Demo</th>
                      <th>Declined</th>
                    </tr>
                    <?php 
                    $grand_total = 0;
                    $grand_adm = 0;
                    $grand_pending = 0;
                    $grand_ddc = 0;
                    $grand_declined = 0;
                    foreach($rows as $row){ 
                      $grand_total +=$row['total_count'];
                      $grand_adm +=$row['done'];
                      $grand_pending +=$row['pending'];
                      $grand_ddc +=$row['ddc'];
                      $grand_declined +=$row['declined'];
                    ?>
                    <tr>
                      <td><?php echo $key.'-'.$row['month_name'];?></td>
                      <td><?php echo $row['total_count'];?></td>
                      <td><?php echo $row['done'];?></td>
                      <td><?php echo $row['pending'];?></td>
                      <td><?php echo $row['ddc'];?></td>
                      <td><?php echo $row['declined'];?></td>
                    </tr>
                    <?php }?>
                    <tr>
                      <th>Grand Total</th>
                      <th><?php echo $grand_total;?></th>
                      <th><?php echo $grand_adm;?></th>
                      <th><?php echo $grand_pending;?></th>
                      <th><?php echo $grand_ddc;?></th>
                      <th><?php echo $grand_declined;?></th>
                    </tr>
                  </table>
                </div>
                <?php 
                }
                ?>
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