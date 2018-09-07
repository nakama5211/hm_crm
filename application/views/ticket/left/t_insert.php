		<form id="form-ticket">
			<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-right-10">
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Người yêu cầu (<span style="color: red;">*</span>)</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="suggestionList" id="answerInput" placeholder="Người yêu cầu" class="col-md-12 no-padding font-size-12">
							<datalist id="suggestionList">
								<?php
		              				foreach ($listuser as $user) {
		              					if($user['roleid']==3){
		              					?>
		              					<option data-value="<?php echo $user['custid']?>"><?php echo $user['custname']?></option>
		              					<?php
		              					}
		              				}
		              			?>
							</datalist>
							<input type="hidden" name="customer" id="customer_request" value="<?php echo($this->uri->segment(4));?>">
							<script type="text/javascript">
								document.querySelector('#answerInput').addEventListener('input', function(e) {
								    var input = e.target,
								        list = input.getAttribute('list'),
								        options = document.querySelectorAll('#' + list + ' option'),
								        hiddenInput = document.getElementById('customer_request'),
								        inputValue = input.value;

								    hiddenInput.value = inputValue;

								    for(var i = 0; i < options.length; i++) {
								        var option = options[i];

								        if(option.innerText === inputValue) {
								            hiddenInput.value = option.getAttribute('data-value');
								            break;
								        }else{
								        	hiddenInput.value="";
								        }
								    }
								});
							</script>
		              	</label>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Người tạo(<span style="color: red;">*</span>)</label>
	              		<label class="control-label col-md-7 no-padding-right">
	              			<input type="" readonly="" name="" value="<?php echo $this->session->userdata('custname')?>">
	              		</label>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Nhóm phụ trách(<span style="color: blue;">*</span>)</label>
	              		<select name="agentgroup" log="Nhóm phụ trách" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control">
	              			<option value=""></option>
		              		<?php if (isset($l_agentgroup) && !empty($l_agentgroup)) {
	              				foreach ($l_agentgroup as $key => $value) {
	              					echo '<option value="'.$value['groupid'].'">'.$value['groupname'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Phụ trách (<span style="color: blue;">*</span>)</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input list="suggestionListAgent" id="agentInput" placeholder="Người phụ trách" class="col-md-12 no-padding font-size-12" value="<?php echo $this->session->userdata('custname')?>">
							<datalist id="suggestionListAgent">
								<?php
		              				foreach ($listuser as $user) {
		              					if($user['roleid']==2){
		              					?>
		              					<option data-group="<?php echo $user['groupid']?>" data-value="<?php echo $user['custid']?>"><?php echo $user['custname']?></option>
		              					<?php
		              					}
		              				}
		              			?>
							</datalist>
							<input type="hidden" name="agentcurrent" id="agentcurrent" value="<?php echo $this->session->userdata('custid')?>">
							<script type="text/javascript">
								document.querySelector('#agentInput').addEventListener('input', function(e) {
								    var input = e.target,
								        list = input.getAttribute('list'),
								        options = document.querySelectorAll('#' + list + ' option'),
								        hiddenInput = document.getElementById('agentcurrent'),
								        inputValue = input.value;

								    hiddenInput.value = inputValue;

								    for(var i = 0; i < options.length; i++) {
								        var option = options[i];

								        if(option.innerText === inputValue) {
								            hiddenInput.value = option.getAttribute('data-value');
								            break;
								        }else{
								        	hiddenInput.value="";
								        }
								    }
								});
							</script>
		              	</label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-right-10">
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Nguồn phiếu</label>
	              		<select name="ticketchannel" log="Nguồn phiếu" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="ticketchannel">
	              			<option value="1">Trực tiếp</option>
	              			<option value="2">Điện thoại</option>
	              			<option value="3">Email</option>
	              			<option value="4">Chat</option>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Mức Ưu tiên</label>
	            		
	            		<select name="priority" log="Mức ưu tiên" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="priority">
	              			<option value="1">Thường</option>
	              			<option value="2">Cao</option>
	              			<option value="3">Khẩn cấp</option>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Tình trạng</label>
	            		<select readonly="" name="ticketstatus" log="Tình trạng" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="ticketstatus">
	            			<option value="1">Tạo mới</option>
	            			<option value="0" disabled="">Đang xử lý</option>
	              			<option value="4" disabled="">Hoàn thành</option>
	              			<option value="9" disabled="">Hủy</option>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Giai đoạn</label>
	              		<select name="levelticket" log="Giai đoạn" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="levelticket">
		              		<?php if (isset($l_stage) && !empty($l_stage)) {
	              				foreach ($l_stage as $key => $value) {
	              					echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
		              		</select>
	              		
	            	</div>
	            </div>
          	</div>
          	
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-right-10">
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Phân loại</label>
	              		<select name="tickettype" log="Phân loại" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="level_1">
	              			<?php if (isset($l_type) && !empty($l_type)) {
	              				foreach ($l_type as $key => $value) {
	              					echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Nhóm vấn đề</label>
	            		<select name="groupid" log="Nhóm vấn đề" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="level_2" value="">
	              			<?php if (isset($l_group) && !empty($l_group)) {
	              				foreach ($l_group as $key => $value) {
	              					echo '<option ref1="'.$value['ref1'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Chi tiết VĐ</label>
	            		<select name="categoryid" log="Chi tiết VĐ" class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" id="level_3" value="">
	              			<?php if (isset($l_cate) && !empty($l_cate)) {
	              				foreach ($l_cate as $key => $value) {
	              					echo '<option ref1="'.$value['ref1'].'" ref2="'.$value['ref2'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Ngày yêu cầu</label>
	              		<label class="control-label col-md-7 no-padding-right">
	              			<input name="createat" log="Ngày yêu cầu" id="createat" class="col-md-12 no-padding font-size-12 crm-control" placeholder="dd-mm-yyyy hh:ii" value="">
	              		</label>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Ngày phản hồi</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input name="lastupdate" log="Ngày phản hồi" id="lastupdate" class="col-md-12 no-padding font-size-12 crm-control" placeholder="dd-mm-yyyy hh:ii" value="">
	              		</label>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Thời hạn SLA</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input name="sla" log="Thời hạn SLA" id="sla" class="col-md-12 no-padding font-size-12 crm-control" placeholder="dd-mm-yyyy hh:ii" value="">
	              		</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Ngày hẹn</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input name="duedate" log="Ngày hẹn" id="duedate" class="col-md-12 no-padding font-size-12 crm-control" placeholder="dd-mm-yyyy hh:ii" value="">
	              		</label>
	            	</div>
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Ngày hoàn thành</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              		   <input name="finishdate" log="Ngày hoàn thành" id="finishdate" class="col-md-12 no-padding font-size-12 crm-control" placeholder="dd-mm-yyyy hh:ii" value="">
	              		</label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-right-10">
	            	<div class="flex">
	            		<label class="control-label user-label col-md-4 no-padding">Mã giao dịch</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              			<input name="transref" log="Mã giao dịch" class="col-md-12 no-padding font-size-12 crm-control" placeholder="" value="">
	              		</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<?php 

	            		if (isset($l_ext)) {
	            			foreach ($l_ext as $key => $value) {
	            				$f = isset($value['fieldcode'])?$value['fieldcode']:'';
	            				$n = isset($value['fieldname'])?$value['fieldname']:'';
	            				$v = isset($extinfo[$value['fieldcode']])?$extinfo[$value['fieldcode']]:'';
	            				$d = '<div class="flex">
					            		<label class="control-label user-label col-md-4 no-padding">'.$n.'</label>';
					            if (isset($value['fieldtype']) && $value['fieldtype']=='T') {
					            	if($this->uri->segment(3) !=null && $value['fieldcode'] =='magd')
					            	{
					            		$d.='
					            		<label class="control-label col-md-8 no-padding-right">
						              		<input class="col-md-12 no-padding font-size-12 crm-ext" log="'.$n.'" value="'.$this->uri->segment(3).'" name="ext['.$f.']">
						              	</label>
					            	';
					            	}
					            	else{
					            	$d.='
					            		<label class="control-label col-md-8 no-padding-right">
						              		<input class="col-md-12 no-padding font-size-12 crm-ext" log="'.$n.'" value="'.$v.'" name="ext['.$f.']">
						              	</label>
					            	';
					            	}
					            }elseif(isset($value['fieldtype']) && $value['fieldtype']=='D'){
					            	$d.='<select class="control-label col-md-8 no-border no-padding margin-left-10 crm-ext" log="'.$n.'" name="ext['.$f.']">';
					            	if (isset($value['datasource']) && isset($l_dtsrc)) {
					            		foreach ($l_dtsrc as $ky => $vl) {
					            			if ($vl['category'] == $value['datasource']) {
					            				$sel = '';
				              					if ($v==$vl['code']) {
				              						$sel = 'selected';
				              					}
				              					$d.='<option '.$sel.' value="'.$vl['code'].'">'.$vl['name'].'</option>';
					            			}
					            		}
					            	}else{
					            		$d.='<option>(Dữ liệu bị lỗi)</option>';
					            	}
					            	$d.='</select>';
					            }else{
					            	$d.='<label>Đang cập nhật</label>';
					            }
					            $d.='</div>';
	            				echo ($d);
	            			}
	            		}

	            	?>
	            </div>
          	</div>
        </form>