<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('header');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">RPT</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>Fees: </h5>
                <div class="row">
                  <div class="col-6">
                    <small>Cash: <?php echo @$today_collection_cash;?>/-</small>    
                  </div>
                  <div class="col-6">
                    <small>Online: <?php echo @$today_collection_online;?>/-</small>   
                  </div>
                </div>
                <hr>
                <!-- <h6><?php //echo date('d-m-Y');?></h6> -->
                <!-- <p>Today Fees</p> -->
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo site_url('fees/view_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h5>This Month Inquiry Call:</h5>
                <div class="row">
                  <div class="col-6">
                    <small><?php echo @$month_inq;?></small>    
                  </div>
                  
                </div>
                <hr>
                <!-- <h6><?php //echo date('d-m-Y');?></h6> -->
                <!-- <p>Course Collection</p> -->
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="<?php //echo site_url('fees/view_fees');?>" class="small-box-footer">View Details <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php
    $this->load->view('footer');
  ?>