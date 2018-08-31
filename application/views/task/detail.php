<main class="app-content padding-5 no-padding-right">
	<form id="all-in"><input type="hidden" name="taskid" value="<?php echo($record[0]['taskid'])?>">
    <div class="row">
        <div class="col-md-3 no-padding padding-left-15 height-1024">
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="margin-top-5">
	            		<label class="control-label user-label col-md-3 no-padding">Trạng thái</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" name="status" log="Trạng thái">
	              			<option value="O" <?php if($record[0]['status']=="O") echo "selected";?>>Chờ xác nhận</option>
	              			<option value="W" <?php if($record[0]['status']=="W") echo "selected";?>>Đang xử lý</option>
	              			<option value="C" <?php if($record[0]['status']=="C") echo "selected";?>>Hoàn thành</option>
	              			<option value="X" <?php if($record[0]['status']=="X") echo "selected";?>>Hủy</option>
	              		</select>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Người yêu cầu</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 data-list crm-control" list="l_cus" required="" readonly log="Người yêu cầu">
		              		<input type="hidden" name="u_request" value="<?php echo($record[0]['taskmaster'])?>">
                            <datalist id="l_cus">
                                <?php if (isset($l_cus)) {
                                  	foreach ($l_cus as $cus) {
                                  		if ($cus['roleid']==3) {
                                  			echo('<option id="'.$cus['custid'].'" value="'.$cus['custname'].'"></option>');
                                  		}
                                  	}
                                } ?>
                            </datalist>
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phụ trách</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 data-list crm-control" list="l_agent" required="" log="Phụ trách">
		              		<input type="hidden" name="u_responsi" value="<?php echo($record[0]['pic'])?>">
                            <datalist id="l_agent">
                                <?php if (isset($l_cus)) {
                                  	foreach ($l_cus as $cus) {
                                  		if ($cus['roleid']==2) {
                                  			echo('<option id="'.$cus['custid'].'" value="'.$cus['custname'].'"></option>');
                                  		}
                                  	}
                                } ?>
                            </datalist>
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phiếu liên quan</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 crm-control"  name="ticketid" value="<?php echo($record[0]['ticketid'])?>" log="Phiếu liên quan" list="l_ticket">
		              		<datalist id="l_ticket">
                                <?php if (isset($l_ticket)) {
                                  	foreach ($l_ticket as $cus) {
                                  		echo('<option value="'.$cus['ticketid'].'"></option>');
                                  	}
                                } ?>
                            </datalist>
		              	</label>
	            	</div>
	            	<div class="hide">
	            		<label class="control-label user-label col-md-3 no-padding">CCs</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10" name="ccs">
	              			<option value="1">ccs</option>
	              		</select>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phân loại</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" log="Phân loại" name="type">
	              			<?php if (isset($l_type) && !empty($l_type)) {
	              				foreach ($l_type as $key => $value) {
	              					$sel = '';
	              					if ($record[0]['tasktype']==$value['code']) {
	              						$sel = 'selected';
	              					}
	              					echo '<option '.$sel.' value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Mức ưu tiên</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10 crm-control" log="Mức ưu tiên" name="priority">
	              			<option value="1" <?php if($record[0]['priority']==1){echo "selected";}?>>Thường</option>
	              			<option value="2" <?php if($record[0]['priority']==2){echo "selected";}?>>Cao</option>
	              			<option value="3" <?php if($record[0]['priority']==3){echo "selected";}?>>Khẩn cấp</option>
	              		</select>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày yêu cầu</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 crm-control" log="Ngày yêu cầu" placeholder="dd-mm-yy hh:ii" name="req_date" value="<?php echo date('Y-m-d h:i',strtotime($record[0]['requestdate']))?>">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Thời hạn OLA</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 crm-control" log="Thời hạn OLA" placeholder="dd-mm-yy hh:ii" name="ola_date" value="<?php echo date('Y-m-d h:i',strtotime($record[0]['sla']))?>">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày hẹn</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 crm-control" log="Ngày hẹn" placeholder="dd-mm-yy hh:ii" name="due_date" value="<?php echo date('Y-m-d h:i',strtotime($record[0]['duedate']))?>">
		              	</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="hide">
	            		<label class="control-label user-label col-md-3 no-padding">Đếm ngược</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="số ngày">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Hoàn thành</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 crm-control" log="Hoàn thành" placeholder="dd-mm-yy hh:ii" name="fns_date" value="<?php echo date('Y-m-d h:i',strtotime($record[0]['finishdate']))?>">
		              	</label>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-right-10">
	              	<div class="row margin-top-5 height-100">
	            		<label class="control-label user-label col-md-3 no-padding">File đính kèm</label>
	              		<label class="control-label col-md-8 no-padding-right">
	              		</label>
	            	</div>
	            </div>
          	</div>
          	<input type="hidden" name="changelog">
		</div>
		<div class="col-md-7 no-padding padding-left-5">
		    <div class="tile no-margin-bot">
		        <div class="content-title">
			        <div class="div margin-bot-10 width-100per">
			          	<h5 class="flex">
			          		<i class="fa fa-lg fa-file-alt header-icon"></i>
			          		<input class="font-size-18 width-100per" type="text" required="" name="title" placeholder="Tiêu đề Công việc" value="<?php echo $record[0]['title'];?>">
			          	</h5>
			          	<p class="header-desc field-click-able">
			          		<!-- <input class="font-size-12" type="text" name="explain" placeholder="Diễn giải"> -->
			          	</p>
			        </div>
			        <!-- <button class="btn btn-primary header-btn" id="btn-accept" type="button">Tiếp nhận</button> -->
			        <!-- <button class="btn btn-blank header-btn btn-caret" type="button"><i class="fa fa-caret-down fa-md float-right"></i></button> -->
			    </div>
			    <div class="break-line margin-bot-5"></div>
			    <div class="row">
			    	<div class="col-md-12 comment-wrap">
						<div class="photo">
							<img class="avatar" src="<?php echo($this->session->userdata('avatar'));?>">
							<input type="hidden" name="avatar" value="<?php echo($this->session->userdata('avatar'));?>">
						</div>
						<div class="comment-block">
							<p class="no-margin">Trả lời</p>
							<div class="status-upload">
								<form>
									<!-- <ul>
										<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Text"><i class="fa fa-font"></i></a></li>
										<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="File"><i class="fa fa-paperclip"></i></a></li>
									</ul> -->
									<!-- <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button> -->
									<textarea name="cmt" placeholder="Nhập bất kỳ một nội dung?"></textarea>
								</form>
							</div><!-- Status Upload  -->
							<button type="submit" class="btn btn-gray float-right margin-top-5 margin-bot-5"><i class="fa fa-share"></i> Lưu
							</button>
						</div>
					</div>
				</div>
		  	</div>
		<div class="comments">
			<p>Lịch sử công việc</p>
			<?php if (isset($comment)) {
				foreach ($comment as $key => $value) {
			?>
			<div>
				<div class="comment-wrap">
					<div class="photo">
						<img class="avatar" src="<?php echo($value['avatar'])?>">
					</div>
					<div class="comment-block padding-5">
						<p class="comment-text"><?php echo($value['custname'])?></p>
						<p class="comment-text"><?php echo($value['tskaction'])?></p>
						<p class="comment-text"><?php echo($value['comments'])?></p>
						<div class="bottom-comment">
							<div class="comment-date"><?php echo($value['changelog'])?></div>
						</div>
					</div>
				</div>
				<ul class="app-breadcrumb breadcrumb react-comment">
		    		<p class="margin-right-30"><?php echo date('d-m-Y h:i',strtotime($value['createddate']))?></p>
			        <!-- <li class="breadcrumb-item"><a href="#">Phản hồi</a></li> -->
			        <!-- <li class="breadcrumb-item"><a href="#">Tạo công việc</a></li> -->
		        </ul>
		    </div>
		    <?php }} ?>
		</div>
	</div>
	</form>
</main>