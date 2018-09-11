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
		                	<?php foreach ($result as $rows) { ?>
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
			                    <td><?php echo date("d/m/Y H:i:s", strtotime($rows['duedate']));?></td>
			                    <td><?php echo date("d/m/Y H:i:s", strtotime($rows['createat']));?></td>
		                  	</tr>	
		                	<?php } ?>				  
		                </tbody>
	              	</table>
	            </div>  
	        </div>
	    </div>