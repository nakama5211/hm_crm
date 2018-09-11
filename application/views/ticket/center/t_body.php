<?php $ticketid = $this->uri->segment(3) ?>
<div class="tile no-margin-bot">
        <div class="content-title">
	        <div class="div width-100per">
	          	<h5 class="flex"><i class="fa fa-lg fa-file-alt header-icon"></i>
	          		<input style="width: 80%
	          		" id="title" name="title" class="no-padding font-size-18 width-95per crm-control" log="Tiêu đề" placeholder="Nhập tiêu đề phiếu hỗ trợ" value="<?php echo $ticket['data'][0]['title'] ?>">
	          	</h5>
	          	<div class="btn-group absolute" role="group" style="right: 10px;top: 15px;">
	          	  <button class="btn btn-primary" type="button" id="btn-accept">Tiếp nhận</button>
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
					<button type="button" title="<?php echo $ticketid ?>" class="btn btn-gray margin-top-5 float-right <?php if($update){ echo "btn-updateAction"; }else{ echo "btn-updateActionUpdate";}  ?>"><i class="fa fa-share"></i> Ghi nhận
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
          	<iframe name="tck_log" class="no-border" style="width: 100%; height: 500px;" src="<?php echo(base_url('ticket/view_ticket_log/'.$this->uri->segment(3)))?>"></iframe>
        </div>
        <div class="tab-pane fade" id="tab-content-2">
          	<iframe name="tck_task" class="no-border" style="width: 100%; height: 500px;" src="<?php echo(base_url('ticket/view_ticket_task/'.$this->uri->segment(3)))?>"></iframe>
        </div>
  	</div>	
</div>
