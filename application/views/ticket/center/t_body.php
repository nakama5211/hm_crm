<?php $ticketid = $this->uri->segment(3) ?>
<div class="tile no-margin-bot">
        <div class="content-title">
	        <div class="div width-100per">
	          	<h5><i class="fa fa-lg fa-file-alt header-icon"></i>
	          		<input style="margin-left: 25px; margin-top: -19px;
	          		" id="title" name="title" class="no-padding font-size-18 width-95per crm-control" log="Tiêu đề" placeholder="Nhập tiêu đề phiếu hỗ trợ" value="<?php echo $ticket['data'][0]['title'] ?>">
	          	</h5>
	          	<p class="header-desc field-click-able">#Phiếu: <?php echo $ticket['data'][0]['ticketid'] ?></p>
	          	<div class="btn-group absolute" role="group" style="right: 10px;top: 15px;">
                  <button class="btn btn-primary dropdown-toggle" id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                  <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end">
                  	<a class="dropdown-item" href="#" tck-id="<?php echo $ticket['data'][0]['ticketid'] ?>" tck-stt="<?php echo $ticket['data'][0]['status'] ?>" tck-title="<?php echo $ticket['data'][0]['title'] ?>" id="btn-ticket-merge">Ghép phiếu</a>
                  	<a class="dropdown-item" href="#">Khác...</a>
                  </div>
                </div>
	        </div>
	    </div>
	    <div class="break-line margin-bot-5"></div>
	    <div class="row">
	    	<div class="col-md-12 comment-wrap">
				<div class="photo">
					<div class="avatar" style="background-image: url('<?php $var = $this->session->userdata;
                    if($var['avatar'] != 'null')
                    {
                    echo $custid = $var['avatar'];
                    }
                    else{ echo 'https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg';} ?>')"></div>
				</div>
				<div class="comment-block">
						<form method="post" enctype= multipart/form-data action="<?php echo base_url().'ticket/insertTicketLog' ?>">
					
					<div class="status-upload">
							<input type="hidden" name="ticketid" value="<?php echo $this->uri->segment(3) ?>">
							<input type="hidden" id="changelog">
							<textarea name="action" id="action" placeholder="Nhập ghi chú" ></textarea>
					</div><!-- Status Upload  -->
					<button type="button" title="<?php echo $ticketid ?>" class="btn btn-gray float-right <?php if($update){ echo "btn-updateAction"; }else{ echo "btn-updateActionUpdate";}  ?>"><i class="fa fa-share"></i> Ghi nhận
					</button>
						</form>
				</div>
			</div>
		</div>
  	</div>
<div class="comments no-padding">
    
    		<ul class="nav nav-tabs no-margin margin-bot-5">
                <li class="nav-item">
                	<a class="user-tab active show" data-toggle="tab" href="#tab-content-1">Lịch sử phiếu</a>
                </li>
                <li class="nav-item">
                	<a class="user-tab" data-toggle="tab" href="#tab-content-2">Công việc</a>
                </li>
          	</ul>
          	<div class="tab-content" id="myTabContent">
                <div class="tab-pane fade active show" id="tab-content-1">
                  	<?php 
				    if(count($listticketlog) >0)
				    {
				    foreach ($listticketlog as $rows) {
				     ?>
					<div class="padding-left-right-10">
						<div class="comment-wrap">
							<div class="photo">
								<div class="avatar" style="background-image: url('<?php echo 'http://crm.tavicosoft.com/api/avatar/'.$rows['useraction'] ?>')"></div>
							</div>
							<div class="comment-block padding-5">
								<p class="comment-text" style="font-weight: 600"><?php echo $rows['custname'] ?></p>
								<p class="comment-text"><?php echo $rows['cmt']?></p>
								<p class="comment-text"><?php echo $rows['action']?></p>
								
								<?php 
									if(strlen($rows['srcrecord'])>5){
										?>
										<audio controls>
										  <source src="<?php echo $rows['srcrecord'] ?>" type="audio/ogg">
										  Your browser does not support the audio tag.
										</audio>
										<?php
									}
								?>
								
								<div class="bottom-comment">
									<div class="comment-date"><?php echo $rows['changelog']?></div>
								</div>
							</div>
						</div>
						<ul class="app-breadcrumb breadcrumb react-comment">
				    		<p class="margin-right-30"><?php echo date('d-m-Y H:i',strtotime($rows['createdat'])); ?></p>
				        </ul>
				    </div>
				    <?php }} ?>
                </div>
                <div class="tab-pane fade" id="tab-content-2">
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
				                            <input type="hidden" name="ticketid" value="<?php echo($ticketid)?>">
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
                </div>
          	</div>	
</div>
