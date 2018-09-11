<main class="app-content padding-5 no-padding-right">
      <div class="row">
        <div class="col-md-3 no-padding padding-left-10 col-md-22">
          	<div class="padding-5 margin-bot-5">
	        	<div class="clearfix">
	        		<div>
		          		<h5 class="tile-title folder-head font-size-12 font-weight-500">Phân chia phiếu <a href="javascript:window.location.reload();" ><i class="fa fa-sync-alt fa-md float-right margin-top-3"></i></a></h5>
		          	</div>
	          		<ul class="nav nav-pills flex-column margin-left-5">
		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3 active show" role="tab" data-toggle="tab" href="#" onclick="locphieu('<?php echo $custid;?>','0',false);">
		                		<p class="no-padding no-margin padding-left-right-10"> Phiếu chưa xử lý của tôi
		                		<label class="float-right">
		                			<?php 
		                				$i = 0;
		                			if(count($result['data'])>0 && $result['code']==1)
		                			{
		                			foreach ($result['data'] as $value) {
		                				if($value['status'] ==0 && $value['agentcurrent']==$custid &&  $value['hidden'] == '0' && $value['status'] != 9)
		                				{
		                					$i++;
		                				}
		                			}
		                			}
		                				echo $i;
		                			 ?>
		                		</label></p>
		                	</a>
		                </li>
		                
		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3" role="tab" data-toggle="tab" href="#" onclick="locphieu('<?php echo $custid;?>','4',false);">
		                		<p class="no-padding no-margin padding-left-right-10"> Phiếu đã hoàn thành
		                		<label class="float-right">
		                			<?php 
		                				$i = 0;
		                			if(count($result['data'])>0 && $result['code']==1)
		                			{
		                			foreach ($result['data'] as $value) {
		                				if($value['status'] == 4 && $value['agentcurrent']==$custid &&  $value['hidden'] == '0' && $value['status'] != 9)
		                				{
		                					$i++;
		                				}
		                			}
		                			}
		                				echo $i;
		                			 ?>
		                		</label></p>
		                	</a>
		                </li>

		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3" role="tab" data-toggle="tab" href="#" onclick="locphieu('<?php echo $custid;?>','-1',true);">
		                		<p class="no-padding no-margin padding-left-right-10"> Phiếu liên quan
		                		<label class="float-right">
		                			<?php 
		                				$i = 0;
		                			if(count($result['data'])>0 && $result['code']==1)
		                			{
		                			foreach ($result['data'] as $value) {
		                				if(($value['agentcreated']==$custid || strpos($value['ticketusers'], $custid) !== false) &&  $value['hidden'] == '0'  && $value['status'] != 9)
		                				{
		                					$i++;
		                				}
		                			}
		                			}
		                				echo $i;
		                			 ?>
		                		</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3" role="tab" data-toggle="tab" href="#" onclick="locphieu('<?php echo $custid;?>','-1',false);">
		                		<p class="no-padding no-margin padding-left-right-10"> Toàn bộ phiếu của tôi
		                		<label class="float-right">
		                			<?php 
		                				$i = 0;
		                			if(count($result['data'])>0 && $result['code']==1)
		                			{	
		                			foreach ($result['data'] as $value) {
		                				if($value['hidden'] == '0')
		                				{
		                					if($value['agentcurrent'] == $custid && $value['hidden'] == '0' && $value['status'] != 9)
		                					{
		                						$i++;
		                					}
		                				}
		                			}
		                			}
		                				echo $i;
		                			 ?>
		                		</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3" role="tab" data-toggle="tab" href="#" onclick="loctheonhom(0);">
		                		<p class="no-padding no-margin padding-left-right-10"> Toàn bộ phiếu của nhóm
		                		<label class="float-right">
		                			(9)
		                		</label></p>
		                	</a>
		                </li>
		                <li>
		                	<a id="a_appbarticket" class="dropdown-item no-padding margin-top-bot-10 border-radius-3" role="tab" data-toggle="tab" href="#" onclick="loctheonhom(1);">
		                		<p class="no-padding no-margin padding-left-right-10"> Phiếu của nhóm chưa xử lý
		                		<label class="float-right">
		                			(9)
		                		</label></p>
		                	</a>
		                </li>
	              	</ul>
	        	</div>
	        </div>
        </div>
        <iframe class="iframesearch" id="iframesearch" style="width: 78%;height:1000px;display: block; border: none;"  src="<?php echo base_url() ?>search/rightSearchTicket/?search=&agentcreated=&agentcurrent=<?php echo $custid;?>&priority=&status=0&lienquan=false"></iframe>
    </div>
</main>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" style="margin-top: 5%" role="document">
    <div class="modal-content">
    	<form name="insertTicket" class="insertTicket" action="<?php echo base_url().'ticket/insertTicket' ?>" method="POST" enctype='multipart/form-data'>
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Tạo phiếu thủ công </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
      		<div class="form-group">
		    <label for="exampleInputEmail1">Tvcdb</label>
		    <input type="text" class="form-control" id="tvcdb" name="tvcdb" placeholder="Tvcdb">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Ticket Id</label>
		    <input type="text" class="form-control" id="ticketid" name="ticketid" placeholder="Ticket Id">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Customer Id</label>
		    <select class="control-label col-md-12 no-padding-right" name="custid">
      			<?php 
      			if(count($customer['data'])>0)
		                			{
      			foreach ($customer['data'] as $rows) { ?>
      				<option value="<?php echo $rows['custid'] ?>"><?php echo $rows['custname'] ?></option>
      			<?php }} ?>
			</select>
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Priority</label>
		    <input type="text" class="form-control" id="priority" name="priority" placeholder="Priority">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Title</label>
		    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
		  </div>

		  <div class="form-group">
		    <label for="exampleInputEmail1">Loại phiếu</label>
		    <select class="control-label col-md-12 no-padding-right" name="status">
      			<option value="1">Phiếu chưa xử lý của tôi</option>
      			<option value="2">Phiếu đang xử lý của tôi</option>
      			<option value="3">Phiếu chưa phân phối</option>
      			<option value="4">Phiếu chưa xử lý của nhóm</option>
      			<option value="5">Phiếu đang xử lý của nhóm</option>
      			<option value="6">Toàn bộ phiếu của nhóm</option>
			</select>
		  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary ">Tạo Phiếu</button>
      </div>
      </form>
    </div>
  </div>
</div>
