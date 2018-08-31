<?php $lq = $this->input->get('lienquan'); ?>
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
	              				<th width="60px">Độ ưu tiên</th>
	              				<th width="50">Đến hạn</th>
	              				<th width="50">Ngày tạo</th>
	              				<!-- <th width="50">Cập nhật</th> -->
	              			</tr>
	              		</thead>
		                <tbody>
		                	<?php 
		                	if(count($result['data']) >0&& $result['code']==1)
		                	{
		                		$i =0;
		                	foreach ($result['data'] as $rows) { 
		                			if($lq == 'false')
		                			{
		                			if(($rows['status']==$status && $rows['agentcurrent']==$agentcurrent && $rows['status'] != 9) || ($status==-1 && $rows['agentcurrent']==$agentcurrent && $rows['status'] != 9 )){
		                		?>
		                	<tr class="border-bot-1">
			                    <td>
			                    	<a class="buttonsearchiframe" onclick="addTab('<?php echo base_url().'ticket/detail/'.$rows['ticketid'].'/'.$rows['custid'].'/'.$rows['idcard'] ?>','#<?php echo $rows['ticketid'] ?>')" href="#">
			                    	<span class="id-label span-warning">P</span>  #<?php echo $rows['ticketid'] ?>
			                    	</a>
			                    </td>
			                    <td>
			                    	<?php echo $rows['title'] ?>
			                    </td>
			                    <td><?php if(isset($rows['custname'])){ echo $rows['custname'];} ?></td>
			                    <td><?php if(isset($rows['agentcurrentname'])){ echo $rows['agentcurrentname'];} ?></td>
			                    <td><?php 
			                    	if ($rows['priority']==1) {echo "Thường";}
			                    	elseif ($rows['priority']==2) {echo "Cao";}
			                    	elseif ($rows['priority']==3) {echo "Khẩn cấp";}
			                    	else {echo "Không xác định";}
			                    ?></td>
			                    <td>
			                    	<?php 
				                    if($rows['duedate']!=null && strtotime($rows['duedate']) > $dayCompare)
				                    {
				                    echo date("d/m/Y", strtotime($rows['duedate']));}?>
			                    	</td>
			                    <td><?php 
			                    if($rows['createat']!=null && strtotime($rows['createat']) > $dayCompare)
			                    {
			                    echo date("d/m/Y", strtotime($rows['createat']));}?></td>
		                  	</tr>	
		                	<?php }}else{
		                		if(($rows['agentcreated'] == $agentcurrent && $rows['status']!= 9) || (strpos($rows['ticketusers'], $agentcurrent) !== false && $rows['status']!= 9)){?>
							<tr class="border-bot-1">
			                    <td>
			                    	<a class="buttonsearchiframe" onclick="addTab('<?php echo base_url().'ticket/detail/'.$rows['ticketid'].'/'.$rows['custid'].'/'.$rows['idcard'] ?>','#<?php echo $rows['ticketid'] ?>')" href="#" title="">
			                    	<span class="id-label span-warning">P</span>  #<?php echo $rows['ticketid'] ?>
			                    	</a>
			                    </td>
			                    <td>
			                    	<?php echo $rows['title'] ?>
			                    </td>
			                    <td><?php if(isset($rows['custname'])){ echo $rows['custname'];} ?></td>
			                    <td><?php if(isset($rows['agentcurrentname'])){ echo $rows['agentcurrentname'];} ?></td>
			                    <td><?php 
			                    	if ($rows['priority']==1) {echo "Thường";}
			                    	elseif ($rows['priority']==2) {echo "Cao";}
			                    	elseif ($rows['priority']==3) {echo "Khẩn cấp";}
			                    	else {echo "Không xác định";}
			                    ?></td>
			                    <td><?php 
				                    if($rows['duedate']!=null && strtotime($rows['duedate']) > $dayCompare)
				                    {
				                    echo date("d/m/Y", strtotime($rows['duedate']));}?></td>
			                    <td><?php 
			                    if($rows['createat']!=null && strtotime($rows['createat']) > $dayCompare)
			                    {
			                    echo date("d/m/Y", strtotime($rows['createat']));}?></td>
		                  	</tr>	
		                		<?php }}}} ?>				  
		                </tbody>
	              	</table>
	            </div>  
	        </div>
	    </div>