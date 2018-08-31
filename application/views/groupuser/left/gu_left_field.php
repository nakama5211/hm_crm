<div class="tile p-0 padding-5 margin-bot-5">
	          <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Tên trường</label>
	            		<?php if (count($detail)>0) {
	            			$fieldname = $detail[0]['fieldname'];
	            			$fieldcode = $detail[0]['fieldcode'];
	            			$status = $detail[0]['status'];
	            		}else{$fieldname='';
	            				$status ='';} ?>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" value="<?php echo $fieldname ?>" placeholder="Nhập họ tên" id="fieldname" required="" minlength="4" maxlength="30">
		              		<input type="hidden" class="col-md-12 no-padding font-size-12" value="<?php echo $fieldcode ?>" placeholder="Nhập họ tên" id="fieldcode" required="" minlength="4" maxlength="30">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Loại nhập liệu</label>
	            		<?php $type = $this->uri->segment(4);
	            				if($type == 'T'){
	            					$typeInput = 'Text';
	            				}
	            				else{ $typeInput = 'SelectBox';} ?>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<input readonly class="col-md-12 no-padding font-size-12" value="<?php echo $typeInput ?>" placeholder="Nhập họ tên" id="type" required="" minlength="4" maxlength="30">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-4 no-padding">Trạng thái</label>
	              		<label class="control-label col-md-7 no-padding-right">
		              		<select class="control-label col-md-12 no-border no-padding" id="status">
	              			<option <?php if ($status!='1'){echo 'selected';} ?> value="0">Không hoạt động</option>
	              			<option <?php if ($status=='1'){echo 'selected';} ?> value="1">Đang hoạt động</option>
	              		</select>
		              	</label>
	            	</div>
	            </div>
 </div>
	            	<div class="fc-corner-right">
		          		<div class="fc-button-group" style="float:right">
							<button type="submit" onclick="uddateFields()" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right btn-createuser">Lưu thông tin</button>
						</div>
		          	</div>