<div class="col-md-100 no-padding padding-left-5">
	    	<div class="tile height-1024">
	            <div class="table-responsive">
	              	<table class="table" id="table-1-searchuser">
	              		<thead class="no-border-top">
	              			<tr>
	              				<th>Tên</th>
	              				<th>Số CMND</th>
	              				<th>Số điện thoại</th>
	              				<th>Email</th>
	              				<th>Cập nhật lần cuối</th>
	              			</tr>
	              		</thead>
		                <tbody>
		                	<?php 
		                	if(count($result['data']) >0)
		                	{
		                	foreach ($result['data'] as $rows) { ?>
		                	<tr class="border-bot-1">
			                    <td width="250">
			                    	<a class="buttonsearchiframe" onclick="addTab('<?php echo base_url().'user/detail/?cusid='.$rows['custid'].'&idcard='.$rows['idcard'].'&roleid='.$rows['roleid'] ?>','<?php echo $rows['custname'] ?>')" href="#" title="">
			                    	<?php echo strtoupper(mb_convert_case($rows['custname'],MB_CASE_UPPER,'UTF-8')) ?>
			                    	</a>
			                    </td>
			                    <td><?php echo $rows['idcard'] ?></td>
			                    <td><?php echo $rows['telephone'] ?></td>
			                    <td><?php echo $rows['email'] ?></td>
			                    <td><?php 
			                    if($rows['lastupdate']!=null && strtotime($rows['lastupdate'])>strtotime('2000/01/01'))
			                    {
			                    echo date("d/m/Y H:i:s", strtotime($rows['lastupdate']));}
			                     ?></td>
		                  	</tr>	
		                	<?php }} ?>				  
		                </tbody>
	              	</table>
	            </div>  
	        </div>
	    </div>