<main class="app-content padding-5 no-padding-right">
    <div class="row">
      	<div class="col-md-12 margin-bot-10 margin-top-5 margin-left-10">
      		<div class="fc-left">
      			<div class="fc-button-group hide">
      				<button type="button" class="fc-month-button fc-button fc-state-default fc-corner-left">Bài viết</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">Quy trình</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default">Thanh lý</button><button type="button" class="fc-agendaWeek-button fc-button fc-state-default fc-state-active fc-corner-right">Thanh lý hợp đồng cọc</button>
      			</div>
      		</div>      	</div>
        <div class="col-md-2 col-md-22 no-padding padding-left-15">
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Phân loại</label>
	            		<select name="type" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_1" value="<?php echo isset($knowledge[0]['tickettype'])?$knowledge[0]['tickettype']:'' ?>">
	              			<?php if (isset($l_type) && !empty($l_type)) {
	              				foreach ($l_type as $key => $value) {
	              					$sel = '';
	              					if (isset($knowledge[0]['tickettype']) && $value['code']==$knowledge[0]['tickettype']) {
	              						$sel = 'selected';
	              					}
	              					echo '<option '.$sel.' value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              				# code...
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Nhóm vấn đề</label>
	            		<select name="group" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_2" value="<?php echo isset($knowledge[0]['groupid'])?$knowledge[0]['groupid']:'' ?>">
	              			<?php if (isset($l_group) && !empty($l_group)) {
	              				foreach ($l_group as $key => $value) {
	              					$sel = '';
	              					if (isset($knowledge[0]['groupid']) && $value['code']==$knowledge[0]['groupid']) {
	              						$sel = 'selected';
	              					}
	              					echo '<option '.$sel.' ref1="'.$value['ref1'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              				# code...
	              			} ?>
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Chi tiết VĐ</label>
	            		<select name="cate" class="control-label col-md-8 no-border no-padding margin-left-10" id="level_3" value="<?php echo isset($knowledge[0]['categoryid'])?$knowledge[0]['categoryid']:'' ?>">
	              			<?php if (isset($l_cate) && !empty($l_cate)) {
	              				foreach ($l_cate as $key => $value) {
	              					$sel = '';
	              					if (isset($knowledge[0]['categoryid']) && $value['code']==$knowledge[0]['categoryid']) {
	              						$sel = 'selected';
	              					}
	              					echo '<option '.$sel.' ref1="'.$value['ref1'].'" ref2="'.$value['ref2'].'" value="'.$value['code'].'">'.$value['name'].'</option>';
	              				}
	              			} ?>
	              		</select>
	            	</div>
	            	
	            </div>
          	</div>
          	<div class="tile p-0 padding-5 margin-bot-5">
	            <div class="tile-body padding-left-10">
	            	<div class="hide">
	            		<label class="control-label user-label col-md-3 no-padding">Quyền sửa</label>
	              		<label class="control-label col-md-8 col-71 no-padding-right">
		              		<input name="right" class="col-md-12 no-padding font-size-12" list="i-right" value="">
		              		<datalist id="i-right">
		              			<option value="0">Tất cả mọi người</option>
		              		</datalist>
		              	</label>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Tag</label>
	            		<select name="ticketprioty" class="control-label col-md-8 no-border no-padding margin-left-10" value="<?php echo isset($knowledge[0]['ticketprioty'])?$knowledge[0]['ticketprioty']:'' ?>">
	            			<?php if (isset($knowledge[0]['ticketprioty'])) {
	            				if ($knowledge[0]['ticketprioty']=='0') {
	            					echo '<option value="0" selected>Thường</option><option value="1">Cao</option><option value="2">Khẩn cấp</option>';
	            				}elseif ($knowledge[0]['ticketprioty']=='1') {
	            					echo '<option value="0">Thường</option><option  selected value="1">Cao</option><option value="2">Khẩn cấp</option>';
	            				}elseif ($knowledge[0]['ticketprioty']=='2') {
	            					echo '<option value="0">Thường</option><option value="1">Cao</option><option  selected value="2">Khẩn cấp</option>';
	            				}
	            			}else{
	            					echo '<option value="0">Thường</option><option value="1">Cao</option><option value="2">Khẩn cấp</option>';
	            				} ?>
	              			
	              			
	              		</select>
	            	</div>
	            	<div class="">
	            		<label class="control-label user-label col-md-3 no-padding">Trạng thái</label>
	            		<select name="status" class="control-label col-md-8 no-border no-padding margin-left-10" value="<?php echo isset($knowledge[0]['hidden'])?$knowledge[0]['hidden']:'' ?>">
	            			<?php if (isset($knowledge[0]['ticketprioty'])) {
	            				if ($knowledge[0]['hidden']=='0') {
	            				 echo '<option value="0" selected>Đang hoạt động</option><option value="1">Ngưng hoạt động</option>';
	            				}elseif ($knowledge[0]['hidden']=='1') {
	            				 echo '<option value="0">Đang hoạt động</option><option selected value="1">Ngưng hoạt động</option>';
	            				}
	            			}else{
	            					echo '<option value="0">Đang hoạt động</option><option value="1">Ngưng hoạt động</option>';
	            				} ?>
	              		</select>
	            	</div>
	            </div>
          	</div>
          	<div class="padding-5 margin-bot-5 padding-left-10">
	          	<div class="">
	        		<label class="control-label user-label col-md-3 no-padding">Đăng bởi</label>
	          		<label class="control-label col-md-8 no-padding-right"><?php echo isset($knowledge[0]['custname'])?$knowledge[0]['custname']:'' ?></label>
	        	</div>
	        	<div class="">
	        		<label class="control-label user-label col-md-3 no-padding">Ngày đăng</label>
	          		<label class="control-label col-md-8 no-padding-right"><?php echo isset($knowledge[0]['createdat'])?date("d-m-Y", strtotime($knowledge[0]['createdat'])):'' ?></label>
	        	</div>
	        	<div class="clearfix hide">
	        		<label class="control-label user-label col-md-3 no-padding">Cập nhật</label>
	          		<label class="control-label col-md-8 no-padding-right no-margin-top">hh:mm dd/mm/yyyy</label>
	        	</div>
	        </div>        
	    </div>
        <div class="col-md-6 col-md-56 no-padding padding-left-5">
          	<div class="tile height-1024">
	            <div class="content-title">
			        <div class="div width-100per">
			          	<h5 id="knl-title"><?php echo isset($knowledge[0]['title'])?$knowledge[0]['title']:'' ?>
			          		<input type="hidden" name="title" value="">
			          	</h5>
			        </div>
			    </div>
			    <div class="bs-component">
			    	<div class="row">
			    		<div class="offset-10 col-md-2 margin-bot-10">
			    			<button class="btn btn-primary float-right" id="ck-edit" type="button"> Chỉnh sửa </button>
			    			<button action="<?php if($this->uri->segment(3)!='')
			    			{
			    				echo $this->uri->segment(3);
			    			}
			    			else
			    			{
			    				echo 'add';
			    			}
			    			 ?>" class="btn btn-primary float-right hide" id="ck-save" type="button"> Lưu </button>
			    		</div>
			    	</div>
			    	<div id="content" ck-edit="close">
		              	<div class="knc-content">
							<!-- Kham pha -->
							<?php echo isset($knowledge[0]['article'])?$knowledge[0]['article']:'' ?>
						</div>
					</div>
	            </div>
          	</div>        </div>
        <div class="col-md-3 col-md-22 no-padding padding-left-5 padding-top-10 hide">
        	<div class="timeline">
			  	<div class="entry">
				    <div class="title gray">
				      	<p class="time-detail">hh:mm:ss</p>
				      	<p class="date-detail">dd/mm/yyyy</p>
				    </div>
				    <div class="body">
				      	<p class="margin-bot-3">System - Hệ thống</p>
				        <p class="no-margin-bot">User History in only two line, User History only in two line. Thanks !!</p>
				    </div>
			  	</div>
			  	<div class="entry">
				    <div class="title red">
				      	<p class="time-detail">hh:mm:ss</p>
				      	<p class="date-detail">dd/mm/yyyy</p>
				    </div>
				    <div class="body">
				      	<p class="margin-bot-3">System - Hệ thống</p>
				        <p class="no-margin-bot">User History in only two line, User History only in two line. Thanks !!</p>
				    </div>
			  	</div>
			  	<div class="entry">
				    <div class="title green">
				      	<p class="time-detail">hh:mm:ss</p>
				      	<p class="date-detail">dd/mm/yyyy</p>
				    </div>
				    <div class="body">
				      	<p class="margin-bot-3">System - Hệ thống</p>
				        <p class="no-margin-bot">User History in only two line, User History only in two line. Thanks !!</p>
				    </div>
			  	</div>
			  	<div class="entry">
				    <div class="title yellow">
				      	<p class="time-detail">hh:mm:ss</p>
				      	<p class="date-detail">dd/mm/yyyy</p>
				    </div>
				    <div class="body">
				      	<p class="margin-bot-3">System - Hệ thống</p>
				        <p class="no-margin-bot">User History in only two line, User History only in two line. Thanks !!</p>
				    </div>
			  	</div>
			</div>        
		</div>
    </div>
</main>