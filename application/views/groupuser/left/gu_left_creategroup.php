<form method="POST" id="dataInsertGroup" action="<?php echo base_url().'groupuser/groupuserinsert' ?>">
<div class="tile p-0 padding-5 margin-bot-5">
	          <div class="tile-body padding-left-10">
	          		<input type="hidden" value="" id="groupid"/>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Tên nhóm</label>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" value="" placeholder="Tên nhóm" name="groupname" id="custname" required="" minlength="4">
		              		<input type="hidden" class="col-md-12 no-padding font-size-12" value="-1" placeholder="" name="roleid" id="roleid" required="" minlength="4">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Trạng thái</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" name="status" id="status">
	              			<option value="0">Không hoạt động</option>
	              			<option value="1">Đang hoạt động</option>
	              		</select>
	            	</div>
	            </div>
	        </div>
	        <div class="tile p-0 padding-5 margin-bot-5">
	             <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Phiếu</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" name="ticketrule" id="ticketrule">
	              			<option value="0" >Không</option>
	              			<option value="1" >Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Người dùng</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" name="userrule" id="userrule">
	              			<option value="0">Không</option>
	              			<option value="1">Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Công việc</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" name="taskrule" id="taskrule">
	              			<option value="0">Không</option>
	              			<option value="1">Xem/Sửa</option>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Thư viện</label>
	              		<select class="control-label col-md-7 no-border no-padding margin-left-10" name="knowledgerule" id="knowledgerule">
	              			<option value="0">Không</option>
	              			<option value="1">Xem/Sửa</option>
	              		</select>
	            	</div>
	            </div>
 </div>
	            	<div class="fc-corner-right">
		          		<div class="fc-button-group" style="float:right">
							<button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right btn-creategroupuser" id="udpategroup_btn">Lưu thông tin</button>
						</div>
		          	</div>
</form>