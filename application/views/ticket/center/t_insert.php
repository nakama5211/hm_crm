
<div class="tile no-margin-bot">
        <div class="content-title">
	        <div class="div width-100per">
	          	<h5><i class="fa fa-lg fa-file-alt header-icon"></i>
	          		<input style="margin-left: 25px; margin-top: -19px;
	          		" id="title" class="no-padding font-size-18 width-95per" placeholder="Nhập tiêu đề phiếu hỗ trợ">
	          	</h5>
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
					
					<div class="status-upload">
							<input type="hidden" name="ticketid" value="<?php echo $this->uri->segment(3) ?>">
							<textarea id="action" name="action" placeholder="Để lại thông tin ghi chú cho phiếu" ></textarea>
					</div><!-- Status Upload  -->
					<button type="submit" class="btn btn-gray float-right margin-top-5 btn-insertTicket"><i class="fa fa-share"></i> Ghi nhận
					</button>
				</div>
			</div>
		</div>
  	</div>