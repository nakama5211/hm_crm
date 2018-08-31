<div class="col-md-100 no-padding padding-left-5">
	    	<div class="tile height-1024">
	            <div class="table-responsive">
	              	<table class="table" id="table-1-searchticket">
	              		<thead class="no-border-top">
	              			<tr>
	              				<th width="100">ID</th>
	              				<th width="250">Tên phiếu</th>
	              				<th width="130px">Người yêu cầu</th>
	              				<th width="130px">Người phụ trách</th>
	              				<th width="75px">Nguồn phiếu</th>
	              				<th width="70px">Độ ưu tiên</th>
	              				<th width="69px">Tình trạng</th>
	              			</tr>
	              		</thead>
		                <tbody>
		                	<?php 
		                	if(count($result['data']) >0&& $result['code']==1)
		                	{
		                	foreach ($result['data'] as $rows) {
		                		if(($rows['agentcurrent'] == $agentcurrent || strpos($rows['ticketusers'], $agentcurrent) !== false) && $rows['hidden'] == 0 && $rows['status'] != 9)
		                		{
		                		?>
		                	<tr class="border-bot-1">
			                    <td>
			                    	<a class="buttonsearchiframe" onclick="addTab('<?php echo base_url().'ticket/detail/'.$rows['ticketid'].'/'.$rows['custid'] ?>','#<?php echo $rows['ticketid'] ?>')" href="#" title="">
			                    	<span class="id-label span-warning">P</span>  #<?php echo $rows['ticketid'] ?>
			                    	</a>
			                    </td>
			                    <td>
			                    	<?php echo $rows['title'] ?>
			                    </td>
			                    <td><?php if(isset($rows['agentcreatedname'])){ echo $rows['agentcreatedname'];} ?></td>
			                    <td><?php if(isset($rows['name'])){ echo $rows['name'];} ?></td>
			                    <td><?php 
			                    	if ($rows['ticketchannel']==2) {echo "Điện thoại";}
			                    	elseif ($rows['ticketchannel']==1) {echo "Trực tiếp";}
			                    	elseif ($rows['ticketchannel']==3) {echo "Email";}
			                    	elseif ($rows['ticketchannel']==4) {echo "Chat";}
			                    	else {echo "Không xác định";}
			                    ?></td>
			                    <td><?php 
			                    	if ($rows['priority']==1) {echo "Thường";}
			                    	elseif ($rows['priority']==2) {echo "Cao";}
			                    	elseif ($rows['priority']==3) {echo "Khẩn cấp";}
			                    	else {echo "Không xác định";}
			                    ?></td>
			                    <td><?php 
			                    	if ($rows['status']==9) {echo "Hủy";}
			                    	elseif ($rows['status']==0) {echo "Đang xử lý";}
			                    	elseif ($rows['status']==4) {echo "Hoàn thành";}
			                    	else {echo "Không xác định";}
			                    ?></td>
		                  	</tr>	
		                	<?php }}} ?>				  
		                </tbody>
	              	</table>
	            </div>  
	        </div>
	    </div>