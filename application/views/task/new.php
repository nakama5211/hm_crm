<main class="app-content padding-5 no-padding-right">
	<form id="all-in">
    <div class="row">
        <div class="col-md-3 no-padding padding-left-15 height-1024">
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="margin-top-5">
	            		<label class="control-label user-label col-md-3 no-padding">Trạng thái</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10" name="status">
	              			<option value="O">Mở</option>
	              			<option value="W">Đang xử lý</option>
	              			<option value="C">Hoàn thành</option>
	              			<option value="X">Hủy</option>
	              		</select>
	            	</div>
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Người yêu cầu</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 data-list" list="l_cus" required="">
		              		<input type="hidden" name="u_request">
                            <datalist id="l_cus">
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
	            		<label class="control-label user-label col-md-3 no-padding">Phụ trách</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12 data-list" list="l_agent" required="">
		              		<input type="hidden" name="u_responsi">
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
		              		<input class="col-md-12 no-padding font-size-12" name="ticketid" list="l_ticket">
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
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10" name="type">
	              			<?php if (isset($l_type) && !empty($l_type)) {
	              				foreach ($l_type as $key => $value) {
	              					echo '<option value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Mức ưu tiên</label>
	              		<select class="control-label col-md-8 no-border no-padding margin-left-10" name="priority">
	              			<option value="1">Thường</option>
	              			<option value="2">Cao</option>
	              			<option value="3">Khẩn cấp</option>
	              		</select>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày yêu cầu</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="dd-mm-yy hh:ii" name="req_date">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Thời hạn OLA</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="dd-mm-yy hh:ii" name="ola_date">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Ngày hẹn</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="dd-mm-yy hh:ii" name="due_date">
		              	</label>
	            	</div>
	            	<div class="break-line margin-bot-5"></div>
	            	<div class=" hide">
	            		<label class="control-label user-label col-md-3 no-padding">Đếm ngược</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="số ngày">
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Hoàn thành</label>
	              		<label class="control-label col-md-8 no-padding-right">
		              		<input class="col-md-12 no-padding font-size-12" placeholder="dd-mm-yy hh:ii" name="fns_date">
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
		</div>
		<div class="col-md-7 no-padding padding-left-5">
		    <div class="tile no-margin-bot">
		        <div class="content-title">
			        <div class="div  margin-bot-10 width-100per">
			          	<h5 class="flex">
			          		<i class="fa fa-lg fa-file-alt header-icon"></i>
			          		<input class="font-size-18 width-100per" type="text" required="" name="title" placeholder="Tiêu đề Công việc">
			          	</h5>
			          	<p class="header-desc field-click-able">
			          		<!-- <input class="font-size-12" type="text" name="explain" placeholder="Diễn giải"> -->
			          	</p>
			        </div>
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
								<!-- <ul class="hide">
									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="Text"><i class="fa fa-font"></i></a></li>
									<li><a title="" data-toggle="tooltip" data-placement="bottom" data-original-title="File"><i class="fa fa-paperclip"></i></a></li>
								</ul> -->
								<textarea name="cmt" placeholder="Nhập bất kỳ một nội dung?"></textarea>
							</div><!-- Status Upload  -->
							<button type="submit" class="btn btn-gray float-right margin-top-5 margin-bot-5">
								<i class="fa fa-share"></i> 
								Lưu
							</button>
						</div>
					</div>
				</div>
		  	</div>
		<div class="comments">
			<p>Lịch sử công việc</p>	
		</div>
	</div>
	</form>
</main>