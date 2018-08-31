<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div">
			          <h5>Nhóm Người dùng</h5>
			        </div>
			    </div>
			    <p class="margin-top-10 no-margin-bot">Nhóm người dùng giúp phân quyền về các chức năng trong hệ thống bao gồm quyền Xem hoặc Sửa, ngoài ra việc phân nhóm người dùng còn hỗ trợ cho các báo cáo về hiệu quả công việc theo nhóm. Việc phản hồi người dùng.</p>
			    <div class="row" style="margin-top: 50px;">
			    	<div class="col-md-5">
			    		<span><b>Nhóm người dùng hiện tại trong hệ thống</b></span>
			    	</div>
			    	<div class="col-md-7">
						    <div style="float: right;">
								<button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right" onclick="addTab('<?php echo base_url()?>groupuser/viewInsertGroup','Thêm nhóm người dùng')">Thêm</button>
							</div>
			    	</div>
			    </div>
			    
				<div class="bs-component margin-top-10">
          			<div class="table-responsive">
		              	<table class="table" id="table-1">
		              		<thead class="no-border-top">
		              			<tr>
		              				<th><b>Nhóm</b></th>
		              				<th><b>Thành viên nhóm</b></th>
		              				<th><b>Quyền của nhóm</b></th>
		              				<th><b>Trạng thái</b></th>
		              			</tr>
		              		</thead>
			                <tbody>
			                	<?php
			                		foreach ($listgroup as $group) {
			                			?>
			                				<tr>
						                		<td><a style="cursor: pointer;" class="user-name" onclick="addTab('<?php echo base_url()?>groupuser/groupuserdetail?groupid=<?php echo $group['groupid']; ?>','<?php echo $group['groupname']; ?>')"><?php  echo $group['groupname'];?></a></td>
						                			<?php 
						                			$totalPeople = '0 Người';
						                			foreach ($countPeople as $count) {
						                				if($count['groupid'] == $group['groupid'])
						                				{
						                					$totalPeople = $count['total'].' Người';
						                					break;
						                				}
						                				else
						                				{
						                					$totalPeople = '0 Người';
						                				}
						                			} ?>
						                		<td id="countpeople">
						                			<?php echo $totalPeople ?>
						                		</td>
						                		<td>
						                			<?php if($group['ticketrule']==1){ echo 'Xem/Sửa yêu cầu phiếu<br>'; }?>
						                			<?php if($group['userrule']==1){ echo 'Xem/Sửa người dùng<br>'; }?>
						                			<?php if($group['taskrule']==1){ echo 'Xem/Sửa công việc<br>'; }?>
						                			<?php if($group['knowledgerule']==1){ echo 'Xem/Sửa thư viện kiến thức'; }?>
						                		</td>
						                		<td><?php if($group['status']==1){ echo 'Đang hoạt động'; }else{echo 'Không hoạt động';}?></td>
						                	</tr>
			                			<?php
			                		}
			                	?>
			                </tbody>
		              	</table>
		            </div>
	            </div>
          	</div>