<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5><?php echo $gdetail['groupname']?></h5>
			        </div>
			    </div>
				<div class="bs-component">
          			<div class="table-responsive" style="width: 1024px">	              
          				<table class="table" id="table">	                
          					<tbody>
                                        <?php if(count($useringroup)>0){ ?>
                                        <?php foreach ($useringroup as $user) {
                                             ?>
                                                  <tr>                     
                                                       <td width="40px">                  
                                                            <img class="user-avatar" src="<?php echo $user['avatar'];?>" alt="User Image">                 
                                                       </td>                 
                                                       <td width="252px">                 
 <a class="user-name" style="cursor: pointer;" onclick="addTab('<?php echo base_url().'user/detail/?cusid='.$user['custid'].'&idcard='.$user['idcard'].'&roleid='.$user['roleid'] ?>','<?php echo $user['custname'];?>')"><?php echo $user['custname'];?></a>
                                                            <p class=""><!--3--></p>               
                                                       </td>                 
                                                       <td width="229px"><?php echo $user['telephone'];?></td>                 
                                                       <td width="218px"><?php echo $user['email'];?></td>            
                                                  </tr>
                                             <?php
                                        }}else{
                                             echo "Chưa có người dùng nào trong nhóm";
                                        } ?>             
          					</tbody>	              
          				</table>	            
          			</div>
	            </div>
          	</div>
               