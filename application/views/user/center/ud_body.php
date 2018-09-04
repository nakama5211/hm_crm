<?php $custidCustomer = $this->input->get('cusid');
	  $var = $this->session->userdata;
      $agentcurrent = $var['custid'];
      $groupid = $var['groupid'];
?>
<div class="tile">
	            <div class="content-title">
			        <div class="div">
			          	<h5><img class="user-avatar" src="<?php echo $user[0]['avatar'] ?>" alt="User Image"> <?php echo $user[0]['custname'] ?></h5>
			        </div>
			        <button id="demoSwal" style="display: none;" type="hidden" class="btn btn-blank" type="button">+ Phiếu hỗ trợ  </button>
			        <button id="demoNotify" style="display: none;" type="hidden" class="btn btn-blank" type="button">+ Thông báo  </button>
			        <button id="demoModal" style="display: none;" type="hidden" class="btn btn-blank" type="button">+ Modal  </button>
			    </div>
			    <div class="bs-component">
	              	<ul class="nav nav-tabs">
		                <li class="nav-item">
		                	<a class="user-tab active show" id="tab1" data-toggle="tab" href="#tab-content-1">Giao dịch (<?php 
		                				$i = 0;
		                				if(count($trade)>0)
		                				{
		                			foreach ($trade as $value) {
		                					$i++;
		                			}}
		                				echo $i;
		                			 ?>)</a>
		                </li>
		                <li class="nav-item">
		                	<a class="user-tab" id="tab2" data-toggle="tab" href="#tab-content-2">Phiếu (<?php 
		                				$i = 0;
		                				if(count($ticket)>0)
		                				{
		                			foreach ($ticket as $rows) {
		                				if(( $rows['custid'] == $agentcurrent ||strpos($rows['ticketusers'],$agentcurrent)!==false || $groupid == $rows['groupid'] ) && $rows['hidden'] =='0')
					                		{
		                					$i++;
		                				}
		                			}}
		                				echo $i;
		                			 ?>)</a>
		                </li>
	              	</ul>
	              	<div class="tab-content" id="myTabContent">
		                <div class="tab-pane fade" id="tab-content-2">

		                	
		                  	<div class="table-responsive" style="height: 400px" id="div-content-2">
				              	<table class="table" id="table-1-ticket">
				              		<thead class="no-border-top">
				              			<tr>
				              				<th width="8%">ID</th>
				              				<th width="20%">Tiêu đề</th>
				              				<th width="6.8%">Ngày yêu cầu</th>
				              				<th width="20%">Người phụ trách</th>
				              				<th width="9%">Ngày cập nhật</th>
				              			</tr>
				              		</thead>
					                <tbody>
					                	<?php 
					                	if(count($ticket) >0)
					                	{
					                	foreach ($ticket as $rows) {
					                		if(( $rows['custid'] == $agentcurrent ||strpos($rows['ticketusers'],$agentcurrent)!==false || $groupid == $rows['groupid'] ) && $rows['hidden'] =='0')
					                		{
					                	 ?>
						                  	<tr class="border-bot-1">
							                    <td width="100">
							                    	<a onclick="addTab('<?php echo base_url().'ticket/detail/'.$rows['ticketid'].'/'.$rows['custid'] ?>','#<?php echo $rows['ticketid'] ?>')" href="#">
							                    	<span class="id-label span-danger">O</span>  #<?php echo $rows['ticketid'] ?></a>
							                    </td>
							                    <td>
							                    	<?php echo $rows['title'] ?>
							                    </td>
							                    <td>
							                    	<?php echo date("d/m/Y", strtotime($rows['createat'])); ?>
							                    </td>
							                    <td><?php echo $rows['custname'] ?></td>
							                    <td>
							                    	<?php echo date("d/m/Y", strtotime($rows['lastupdate'])); ?></td>
						                  	</tr>
					                	<?php }}} ?>
					                </tbody>
				              	</table>
				            </div>
		                </div>
		                <div class="tab-pane fade" id="tab-content-3">
		                  <p>Phiếu liên quan.</p>
		                </div>
		                <div  class="tab-pane fade active show" id="tab-content-1">
		                	<div class="table-responsive" id="div-content-1" style="height: 294px;">
		                		<table class="table table-striped table-bordered" cellspacing="0" id="table-1-contract">
				              		<thead>
								    <tr>
								        <th>Mã GD</th>
			              				<th>Tình trạng</th>
			              				<th>Mã căn hộ</th>
			              				<th>Ngày bắt đầu</th>
			              				<th>Ngày hiệu lực</th>
				              			<th>Ghi chú</th>
								    </tr>
									</thead>
									
				              	</table>
				            </div>
		                </div>
	              	</div>
	            </div>
          	</div>