<div class="tile p-0 padding-5 margin-bot-5">
	          <div class="tile-body padding-left-10">
	          		<input type="hidden" value="<?php echo $gdetail['groupid'];?>" id="groupid"/>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Tên nhóm</label>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" value="<?php echo $gdetail['groupname']?>" placeholder="Tên nhóm" id="custname" required="" minlength="4" maxlength="30">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Trạng thái</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" id="status">
	              			<option value="0" <?php if($gdetail['status']==0){echo "selected";} ?>>Không hoạt động</option>
	              			<option value="1" <?php if($gdetail['status']==1){echo "selected";} ?>>Đang hoạt động</option>
	              		</select>
	            	</div>
	            </div>
	        </div>
	        <div class="tile p-0 padding-5 margin-bot-5">
	             <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Phiếu</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" id="ticketrule">
	              			<option value="0" <?php if($gdetail['ticketrule']==0){echo "selected";} ?>>Không</option>
	              			<option value="1" <?php if($gdetail['ticketrule']==1){echo "selected";} ?>>Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Người dùng</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" id="userrule">
	              			<option value="0" <?php if($gdetail['userrule']==0){echo "selected";} ?>>Không</option>
	              			<option value="1" <?php if($gdetail['userrule']==1){echo "selected";} ?>>Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Công việc</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" id="taskrule">
	              			<option value="0" <?php if($gdetail['taskrule']==0){echo "selected";} ?>>Không</option>
	              			<option value="1" <?php if($gdetail['taskrule']==1){echo "selected";} ?>>Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Thư viện</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" id="knowledgerule">
	              			<option value="0" <?php if($gdetail['knowledgerule']==0){echo "selected";} ?>>Không</option>
	              			<option value="1" <?php if($gdetail['knowledgerule']==1){echo "selected";} ?>>Xem/Sửa</option>
	              		</select>
	            	</div>
	            </div>
 </div>
	            	<div class="fc-corner-right">
		          		<div class="fc-button-group" style="float:right">
							<button type="submit" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right btn-createuser" id="udpategroup_btn">Lưu thông tin</button>
						</div>
		          	</div>
