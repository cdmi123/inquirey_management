<?php
defined('BASEPATH') OR exit('No direct script access allowed');       
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
  }else if($info['status']=="IC"){
    $class = "color:#00cc00;";
    $status = "In Calling";
  }else if($info['status']=="T"){
    $class = "color:#618500;";
    $status = "Branch Transfer";
  }
  //$staff_info = $this->CommonModel->get_staff_info($info['inquiry_by']);
  // $demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
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
  <td><?php echo $info['inq_details'];?></td>
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
    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('followup/add_followup_data/'.$info['id']); ?>"><div class="fas fa-plus"></div></a>
    <?php if($info['status'] != "A") {  ?>
    <a class="btn btn-primary btn-xs m-1" href="<?php echo site_url('admission/index/'.$info['id'].'/offline') ?>" class="badge badge-success">Admission</a>
    <?php } ?>
  </td>
</tr>
<?php } ?>