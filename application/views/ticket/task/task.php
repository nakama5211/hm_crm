            <div class="tile">
          		<div class="content-title">
			        <div class="div">
			          	<p id="_count-task"><?php echo(isset($_task)?count($_task):'0')?> công việc</p>
			        </div>
			        <button class="btn btn-primary header-btn" type="button" id="_btn-task">Công việc</button>
			    </div>
			    <div class="hide" id="_form-task">
			    	<form id="f_task">
			    	<input type="" name="title" placeholder="Tiêu đề công việc" required="">
			    	<ul class="nav nav-tabs no-margin">
		                <li class="nav-item">
		                	<a class="tsk-link active show" data-toggle="tab" href="#tab1"><i class="fa fa-user"></i></a>
		                </li>
		                <li class="nav-item hide">
		                	<a class="tsk-link" data-toggle="tab" href="#tab2"><i class="fa fa-align-left"></i></a>
		                </li>
		                <li class="nav-item hide">
		                	<a class="tsk-link" data-toggle="tab" href="#tab3"><i class="fa fa-paperclip"></i></a>
		                </li>
		          	</ul>
		          	<div class="tab-content" id="myTabContent">
        				<div class="tab-pane fade active show" id="tab1">
        					<div class="hole">
        						<div class="col-md-4">
        							<label class="tsk-label">Loại hình công việc</label>
        							<select class="tck-select" name="type">
        								<?php if (isset($l_type) && !empty($l_type)) {
				              				foreach ($l_type as $key => $value) {
				              					echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
				              				}
				              			} ?>
        							</select>
        						</div>
        						<div class="col-md-4">
        							<label class="tsk-label">Người phụ trách</label>
        							<input class="tck-input data-list" list="l_cus" required="" name="realname">
				              		<input type="hidden" name="u_responsi">
		                            <datalist class="_data" id="l_cus">
		                                <?php if (isset($listuser)) {
		                                  	foreach ($listuser as $cus) {
		                                  		if ($cus['roleid']==2) {
		                                  			echo('<option id="'.$cus['custid'].'" value="'.$cus['custname'].'"></option>');
		                                  		}
		                                  	}
		                                } ?>
		                            </datalist>
		                            <input type="hidden" name="u_request" value="<?php echo($this->session->userdata('custid'))?>">
		                            <input type="hidden" name="ticketid" value="<?php echo($this->uri->segment(3))?>">
        						</div>
        						<div class="col-md-4">
        							<label class="tsk-label">Mức ưu tiên</label>
        							<select class="tck-select">
        								<option value="1">Thường</option>
        								<option value="1">Cao</option>
        								<option value="1">Khẩn cấp</option>
        							</select>
        						</div>
        						<div class="col-md-4 margin-top-10">
        							<label class="tsk-label">Bắt đầu</label>
        							<input class="tck-input" type="" name="req_date" required="">
        						</div>
        						<div class="col-md-4 margin-top-10">
        							<label class="tsk-label">Kết thúc</label>
        							<input class="tsk-input" type="" name="fns_date" required="">
        						</div>
        						<div class="col-md-4 margin-top-20">
        							<button type="submit" class="btn btn-gray float-right margin-top-10">
        								<i class="fa fa-share"></i> 
        							Lưu </button>
        							<button type="button" id="_cancel" class="btn btn-default float-right margin-top-10 margin-right-5">
        								<i class="fa fa-share"></i> 
        							Hủy </button>
        						</div>
        					</div>
        				</div>
        				<div class="tab-pane fade" id="tab2">
        					<div class="hole">
        						<div class="col-md-12">
        							<label class="tsk-label">Ghi chú</label>
        							<textarea></textarea>
        						</div>
        						<div class="col-md-12">
        							<button type="submit" class="btn btn-gray float-right margin-top-10">
        								<i class="fa fa-share"></i> 
        							Lưu </button>
        							<button type="button" id="_cancel" class="btn btn-default float-right margin-top-10 margin-right-5">
        								<i class="fa fa-share"></i> 
        							Hủy </button>
        						</div>
        					</div>
        				</div>
        				<div class="tab-pane fade" id="tab3">
        					<div class="hole">
        						<div class="col-md-6">
        							<label class="tsk-label">Đính kèm file</label>
        							<input type="file" name="">
        						</div>
        						<div class="col-md-12">
        							<button type="submit" class="btn btn-gray float-right margin-top-10">
        								<i class="fa fa-share"></i> 
        							Lưu </button>
        							<button type="submit" class="btn btn-default float-right margin-top-10 margin-right-5">
        								<i class="fa fa-share"></i> 
        							Hủy </button>
        						</div>
        					</div>
        				</div>
        			</div>
        			</form>
			    </div>
			    <div class="table-responsive">
	              	<table class="table" id="_tb-task">
		                <tbody>
		                	<?php if (isset($_task)) {
		                		foreach ($_task as $key => $value) {
		                			$class = '';$icon='';
		                			if ($value['status']=='O') {
		                				$class = 'label-circle label-default span-default';$icon = 'fa fa-check';
		                			}elseif ($value['status']=='W') {
		                				$class = 'label-circle label-warning span-warning';$icon = 'fa fa-exclamation';
		                			}elseif ($value['status']=='C') {
		                				$class = 'label-circle span-success';$icon = 'fa fa-check';
		                			}
		                	?>
		                	<tr class="border-bot-1">
			                    <td width="150">
			                    	<div class="flex">
			                    		<span class="<?php echo($class)?>">
			                    			<i class="<?php echo($icon)?>"></i>
			                    		</span>  
			                    		<div class="task-user-name"><?php echo($value['createdby'])?></div>
			                    	</div>
			                    </td>
			                    <td width="300">
			                    	<a class="new_tab" onclick="addTab('<?php echo(base_url('task/detail/'.$value['taskid']))?>','#<?php echo($value['taskid'])?>')" href="#"><?php echo($value['title'])?></a>
			                    </td>
			                    <td><?php echo date('Y/m/d h:i',$value['finishdate'])?></td>
		                  	</tr>
		                	<?php }} ?>
		                </tbody>
	              	</table>
	            </div>
          	</div>