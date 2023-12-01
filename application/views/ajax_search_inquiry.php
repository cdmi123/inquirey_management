 <?php 
                $this->load->model('Inquiry_model');
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
                    //$demo_details = $this->Inquiry_model->get_inquiry_demo($info['id'],'offline');
                    
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
                    <td><?php echo $info['reference'];?> <div style="border-top: solid 1px black;margin-top: 5px"><?php echo $info['reference_name'];?></td>
                    
                    <td><?php echo $info['batch_time'];?>  <div style="border-top: solid 1px black;margin-top: 5px"> <?php echo $info['demo_date'] ?></td>
                    
               
                    <td>

                      <a href="javascript:void(0);" class="btn btn-primary btn-xs m-1 update-status" data-status="<?php echo $info['status'];?>" data-inqid="<?php echo $info['id'];?>" data-note="<?php echo $info['status_note'];?>" data-toggle="tooltip" data-placement="top" title="<?php echo $info['status_note'];?>"><?php echo $info['status'];?></a>

                    </td>
                    <td><?php echo $info['extra_information']?></td>
                    <td><?php echo $staff_info['name'];?></td>


                   
                    <td align="center">
                      <a href="<?php echo site_url('inquiry/index/'.$info['id']);?>"><div class="fas fa-edit"></div></a>
                      &nbsp<a href="<?php echo site_url('followup/view_followup/'.$info['id']);?>"><div class="fas fa-eye"></div></a>
                      <?php 
                      if($this->session->userdata('user_role')!=3){
                      ?>
                      &nbsp<a href="<?php echo site_url('/demolecture/add_demo_offline/offline/'.$info['id']);?>"><div class="fas fa-clock"></div></a>
                      <?php }?>
                      <span class="badge badge-warning"><?php echo $cnt-1;?></span>
                     
                      <?php if($info['status'] != "A") {  ?>
                      <a href="<?php echo site_url('admission/index/'.$info['id']) ?>" class="badge badge-success">Admission</a>
                      <?php } ?>
                    </td>
                </tr>
              <?php } ?>